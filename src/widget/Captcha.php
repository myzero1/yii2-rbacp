<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 */

namespace myzero1\rbacp\widget\Captcha;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\jui\JuiAsset;
use yii\widgets\InputWidget;

/**
 * Class Upload
 * @package trntv\filekit\widget
 */
class Upload extends InputWidget
{
    /**
     * @var
     */
    public $files;
    /**
     * @var array|\ArrayObject
     */
    public $url;
    /**
     * @var array
     */
    public $clientOptions = [];
    /**
     * @var bool
     */
    public $showPreviewFilename = false;
    /**
     * @var bool
     */
    public $multiple = false;
    /**
     * @var bool
     */
    public $sortable = false;
    /**
     * @var int min file size in bytes
     */
    public $minFileSize;
    /**
     * @var int
     */
    public $maxNumberOfFiles = 1;
    /**
     * @var int max file size in bytes
     */
    public $maxFileSize;
    /**
     * @var string regexp
     */
    public $acceptFileTypes;
    /**
     * @var array
     */
    public $acceptFileTypesNew;
    /**
     * @var string
     */
    public $messagesCategory = 'myzero1\yii2upload';
    /**
     * @var bool preview image file or not in the upload box.
     */
    public $previewImage = true;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->registerMessages();
    }

    /**
     * @return void Registers widget translations
     */
    protected function registerMessages()
    {
        if (!array_key_exists($this->messagesCategory, Yii::$app->i18n->translations)) {
            Yii::$app->i18n->translations[$this->messagesCategory] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => __DIR__ . '/messages',
                'fileMap' => [
                    $this->messagesCategory => 'filekit/widget.php'
                ],
            ];
        }
    }

    /**
     * @return string
     */
    public function getFileInputName()
    {
        return sprintf('_fileinput_%s', $this->id);
    }

    /**
     * @return string
     */
    public function run()
    {
        $this->registerClientScript();
        $content = Html::beginTag('div');
        $content .= Html::hiddenInput($this->name, null, [
            'class' => 'empty-value',
            'id' => $this->options['id']
        ]);
        $content .= Html::fileInput($this->getFileInputName(), null, [
            'name' => $this->getFileInputName(),
            'id' => $this->getId(),
            'multiple' => $this->multiple
        ]);
        $content .= Html::endTag('div');
        return $content;
    }

    /**
     * Registers required script for the plugin to work as jQuery File Uploader
     */
    public function registerClientScript()
    {
        UploadAsset::register($this->getView());
        $options = Json::encode($this->clientOptions);
        if ($this->sortable) {
            JuiAsset::register($this->getView());
        }
        $this->getView()->registerJs("jQuery('#{$this->getId()}').yiiUploadKit({$options});");
    }
}
