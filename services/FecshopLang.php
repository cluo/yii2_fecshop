<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecshop\services;
use Yii;
use yii\base\InvalidValueException;
use yii\base\InvalidConfigException;
use yii\base\BootstrapInterface;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Fecshoplang extends Service
{
	/**
	 * all languages
	 */
	public $allLangCode;
	
	/**
	 * default language
	 */
	public $defaultLangCode; 
	
	
	/**
	 * @property $attrName|String  , attr name ,like  : tilte , description ,name etc..
	 * @property $langCode|String , language 2 code, like :en ,fr ,es,
	 *  get language child language attr, like: title_fr
	 */
	public function getLangAttrName($attrName,$langCode){
		return $attrName.'_'.$langCode;
	}
	
	public function getDefaultLangAttrName($attrName){
		return $attrName.'_'.$this->defaultLangCode;
	}
	
	/**
	 * @property $attrVal|Array , language attr array , like   ['title_en' => 'xxxx','title_fr' => 'yyyy']
	 * @property $attrName|String, attribute name ,like: title ,description. 
	 * get default language attr value.
	 * example getDefaultLangAttrVal(['title_en'=>'xx','title_fr'=>'yy'],'title');
	 */
	public function getDefaultLangAttrVal($attrVal,$attrName){
		$defaultLangAttrName = $this->getDefaultLangAttrName($attrName);
		if(isset($attrVal[$defaultLangAttrName]) && !empty($attrVal[$defaultLangAttrName])){
			return $attrVal[$defaultLangAttrName];
		}
		return '';
	}
	
	/**
	 * @property $attrVal|Array , language attr array , like   ['title_en' => 'xxxx','title_fr' => 'yyyy']
	 * @property $attrName|String, attribute name ,like: title ,description. 
	 * @property $lang | String , language.
	 * if  object or array  attribute is a language attribute, you can get current 
	 * language value by this function.
	 * if lang attribute in current store language is empty , default language attribute will be return. 
	 * if attribute in default language value is empty, '' will be return. 
	 * example getLangAttrVal(['title_en'=>'xx','title_fr'=>'yy'],'title','fr');
	 */
	public function getLangAttrVal($attrVal,$attrName,$langCode){
		$langAttrName = $this->getLangAttrName($attrName,$langCode);
		if(isset($attrVal[$langAttrName]) && !empty($attrVal[$langAttrName])){
			return $attrVal[$langAttrName];
		}else{
			$defaultLangAttrName = $this->getDefaultLangAttrName($attrName);
			if(isset($attrVal[$defaultLangAttrName]) && !empty($attrVal[$defaultLangAttrName])){
				return $attrVal[$defaultLangAttrName];
			}
		}
		return '';
	}
	
	
	
	/**
	 * @property $language|String  like: en_US ,fr_FR,zh_CN
	 * @return String , like  en ,fr ,es ,  if  $language is not exist in $this->allLangCode
	 * empty will be return.
	 */
	public function getLangCodeByLanguage($language){
		if(isset($this->allLangCode[$language])){
			return $this->allLangCode[$language];
		}else{
			return '';
		}
	}
	
	
}