<?php

namespace app\components;

use Yii;
use yii\web\UploadedFile;
use app\components\Media;

class ManageUploadedProfileFiles {

    /**
     * @var array
     */
    protected static $_instances = array();

    /**
     * folder path 
     * @var string 
     */
    protected $_path = null;

    /**
     * folder chmod
     * @var string 
     */
    protected $_mode = 0775;

    /**
     * folder url 
     * @var string 
     */
    protected $_url = null;

    /**
     * Cdn uploader class
     * @var CdnUploader
     */
    protected $_cdn;

    /**
     * File config array
     * @var string 
     */
    protected $_fileConfig = array();

    /**
     *
     * @param array $fileConfig
     * @param string $profileCode 
     */
    private function __construct($fileConfig, $profileCode) {
        $this->_fileConfig = $fileConfig;
        if (isset($fileConfig['info']['otherPath'])) {
            $this->_path = $fileConfig['info']['otherPath'] . "/" . $profileCode;
        }else{
            $this->_path = Yii::getAlias('@webroot') . "/" . $fileConfig['info']['path'] . "/" . $profileCode;
        }
        
        if (isset($fileConfig['info']['baseUrl'])) {
            $this->_url = $fileConfig['info']['baseUrl'] . "/{$fileConfig['info']['path']}/{$profileCode}";
        } else if (isset($fileConfig['info']['otherBaseUrl'])) {
            $this->_url = $fileConfig['info']['otherBaseUrl'] . "/{$profileCode}";
        } else {
            $this->_url = Yii::getAlias('@web') . "/{$fileConfig['info']['path']}/{$profileCode}";
        }
        
        if (isset($fileConfig['info']['subFolder'])) {
            $this->_path    .= "/" . $fileConfig['info']['subFolder'];
            $this->_url     .= "/" . $fileConfig['info']['subFolder'];
        }
    }

    /**
     *
     * @param array $fileConfig
     * @param array  $code
     */
    
    public static function &getInstance($fileConfig, $profileCode) {
        //die(print_r($fileConfig)); 
        if(isset($fileConfig['info']['otherBaseUrl'])){
            $path = "{$fileConfig['info']['otherBaseUrl']}/";
        }else{
            $fileConfig['info']['path'] = trim($fileConfig['info']['path'], "/");
            $path = "{$fileConfig['info']['path']}/";
        }
        
        if (isset($fileConfig['info']['subFolder'])) {
            $path .= $fileConfig['info']['subFolder'];
        }
        
        if (!isset(self::$_instances[$path])) {
            self::$_instances[$path] = new self($fileConfig, $profileCode);
        }
        return self::$_instances[$path];
    }

    /**
     * get url
     * @return string 
     */
    public function getUrl() {
        return $this->_url;
    }

    /**
     * get path
     * @return string 
     */
    public function getPath() {
        return $this->_path;
    }

    /**
     * Creae folder if not exist 
     */
    protected function createFolderPath() {
        $path = $this->_path;
        if (isset($this->_fileConfig['info']['sizes'])) {
            $path = $this->_path . "/" . "sizes";
        }
        if (!is_dir($path)) {
            mkdir($path, $this->_mode, true);
        }
    }

    /**
     * Save image
     * @param string $currentFile current file to saved
     * @param CUploadedFile $uploadedFile
     * @param string $oldFile old file to deleted      
     * @access public
     * @return void
     */
    public function saveImage($currentFile, UploadedFile $uploadedFile = null, $oldFile = null) {
        $this->createFolderPath();
        $currentFileParts = explode(".", $currentFile, 2);
//        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if (($uploadedFile instanceof UploadedFile) && count($currentFileParts) == 2) {
            if ($oldFile) {
                $oldFileParts = explode(".", $oldFile, 2);
            }
            $sizesPath = $this->_path . "/" . "sizes";
            $imageFile = $this->_path . "/" . $currentFile;
            $oldImageFile = ($oldFile) ? $this->_path . "/" . $oldFile : NULL;
            $oldSizes = array();
            $newSizes = array();
            $imageUploadedSize = getimagesize($uploadedFile->tempName);
            if ($imageUploadedSize[0] < $this->_fileConfig['info']['width']) {
                $this->_fileConfig['info']['width'] = $imageUploadedSize[0];
            }
            if ($imageUploadedSize[0] < $this->_fileConfig['info']['height']) {
                $this->_fileConfig['info']['height'] = $imageUploadedSize[1];
            }

            if (count($this->_fileConfig['info']['sizes'])) {
                foreach ($this->_fileConfig['info']['sizes'] as $postFix => $size) {
                    if ($oldFile != $currentFile && is_file($oldImageFile) && count($oldFileParts) == 2) {
                        $oldSizes[] = $sizesPath . "/" . "{$oldFileParts[0]}-{$postFix}.{$oldFileParts[1]}";
                    }
                    if ($size['width']) {
                        $resizeOn = Media::RESIZE_BASED_ON_WIDTH;
                        if ($size['width'] < 1) {
                            $newSize = $this->_fileConfig['info']['width'] * $size['width'];
                        } else {
                            $newSize = $size['width'];
                        }
                    } else if ($size['height']) {
                        $resizeOn = Media::RESIZE_BASED_ON_HEIGHT;
                        if ($size['height'] < 1) {
                            $newSize = $this->_fileConfig['info']['height'] * $size['height'];
                        } else {
                            $newSize = $size['height'];
                        }
                    }
                    $newSizes[] = array(
                        'file' => $sizesPath . "/" . "{$currentFileParts[0]}-{$postFix}.{$currentFileParts[1]}",
                        'newSize' => $newSize,
                        'resizeOn' => $resizeOn,
                    );
                }
            }
            if (is_file($oldImageFile) && $oldImageFile && $oldFile != $currentFile) {
                unlink($oldImageFile);
                foreach ($oldSizes as $oldSize) {
                    unlink($oldSize);
                }
            }
            foreach ($newSizes as $newSize) {
                Media::resize($uploadedFile->tempName, $newSize['newSize'], $newSize['resizeOn'], $newSize['file']);
            }
            Media::resize($uploadedFile->tempName, $this->_fileConfig['info']['width'], $this->_fileConfig['info']['resizeOn'], $imageFile);
        }
    }

    /**
     * Save image
     * @param string $currentFile current file to saved
     * @param CUploadedFile $uploadedFile
     * @param string $oldFile old file to deleted      
     * @access public
     * @return void
     */
    public function saveImageFromPath($currentFile, $originalImageDir) {
        $this->createFolderPath();
        $currentFileParts = explode(".", $currentFile, 2);
//        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if (count($currentFileParts) == 2) {
            $sizesPath = $this->_path . "/" . "sizes";
            $imageFile = $this->_path . "/" . $currentFile;
            $newSizes = array();
            $imageUploadedSize = getimagesize($originalImageDir);
            if ($imageUploadedSize[0] < $this->_fileConfig['info']['width']) {
                $this->_fileConfig['info']['width'] = $imageUploadedSize[0];
            }
            if ($imageUploadedSize[0] < $this->_fileConfig['info']['height']) {
                $this->_fileConfig['info']['height'] = $imageUploadedSize[1];
            }

            if (count($this->_fileConfig['info']['sizes'])) {
                foreach ($this->_fileConfig['info']['sizes'] as $postFix => $size) {

                    if ($size['width']) {
                        $resizeOn = Media::RESIZE_BASED_ON_WIDTH;
                        if ($size['width'] < 1) {
                            $newSize = $this->_fileConfig['info']['width'] * $size['width'];
                        } else {
                            $newSize = $size['width'];
                        }
                    } else if ($size['height']) {
                        $resizeOn = Media::RESIZE_BASED_ON_HEIGHT;
                        if ($size['height'] < 1) {
                            $newSize = $this->_fileConfig['info']['height'] * $size['height'];
                        } else {
                            $newSize = $size['height'];
                        }
                    }
                    $newSizes[] = array(
                        'file' => $sizesPath . "/" . "{$currentFileParts[0]}-{$postFix}.{$currentFileParts[1]}",
                        'newSize' => $newSize,
                        'resizeOn' => $resizeOn,
                    );
                }
            }

            foreach ($newSizes as $newSize) {
                Media::resize($originalImageDir, $newSize['newSize'], $newSize['resizeOn'], $newSize['file']);
            }
            Media::resize($originalImageDir, $this->_fileConfig['info']['width'], $this->_fileConfig['info']['resizeOn'], $imageFile);
        }
    }

    /**
     * Save file    
     * @param string $currentFile current file to saved
     * @param CUploadedFile $uploadedFile
     * @param string $oldFile old file to deleted      
     * @access public
     * @return void
     */
    public function saveFile($currentFile, UploadedFile $uploadedFile = null, $oldFile = null) {
        $currentFileParts = explode(".", $currentFile, 2);
        if (($uploadedFile instanceof UploadedFile) && count($currentFileParts) == 2) {
            $this->createFolderPath();
            $attachFile = $this->_path . "/" . $currentFile;
            $oldAttachFile = ($oldFile) ? $this->_path . "/" . $oldFile : NULL;
            if (is_file($oldAttachFile) && $oldAttachFile && $currentFile != $oldFile) {
                unlink($oldAttachFile);
            }
            $uploadedFile->saveAs($attachFile);
        } else {
            throw new \yii\web\HttpException(500, 'Error Saving the file' . $currentFile);
        }
    }

    /**
     * Save file     
     * @param string $currentFile current file to deleted
     * @access public
     * @return void
     */
    public function deleteFile($currentFile) {
        $deletedFile = $this->_path . "/" . $currentFile;
        if (is_file($deletedFile)) {
            unlink($deletedFile);
        }
    }

    /**
     * Delete image
     * @param string $currentFile current file to saved         
     * @access public
     * @return void
     */
    public function deleteImage($currentFile) {
        $sizesPath = $this->_path . "/" . "sizes";
        $imageFile = $this->_path . "/" . $currentFile;
        $currentFileParts = explode(".", $currentFile, 2);
        if (count($currentFileParts) == 2) {
            if (is_file($imageFile)) {
                unlink($imageFile);
            }
            if (count($this->_fileConfig['info']['sizes'])) {
                foreach ($this->_fileConfig['info']['sizes'] as $postFix => $size) {
                    $size = $sizesPath . "/" . "{$currentFileParts[0]}-$postFix.{$currentFileParts[1]}";
                    if (is_file($size)) {
                        unlink($size);
                    }
                }
            }
        }
    }

}
