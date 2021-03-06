<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TransformationRuleSetDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $internationalCode = '00';

    /**
     * @var string
     */
    private $trunkPrefix = '';

    /**
     * @var string
     */
    private $areaCode = '';

    /**
     * @var integer
     */
    private $nationalLen = 9;

    /**
     * @var boolean
     */
    private $generateRules = false;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn;

    /**
     * @var string
     */
    private $nameEs;

    /**
     * @var string
     */
    private $nameCa;

    /**
     * @var string
     */
    private $nameIt;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $country;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleDto[] | null
     */
    private $rules = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'description' => 'description',
            'internationalCode' => 'internationalCode',
            'trunkPrefix' => 'trunkPrefix',
            'areaCode' => 'areaCode',
            'nationalLen' => 'nationalLen',
            'generateRules' => 'generateRules',
            'id' => 'id',
            'name' => ['en','es','ca','it'],
            'brandId' => 'brand',
            'countryId' => 'country'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'description' => $this->getDescription(),
            'internationalCode' => $this->getInternationalCode(),
            'trunkPrefix' => $this->getTrunkPrefix(),
            'areaCode' => $this->getAreaCode(),
            'nationalLen' => $this->getNationalLen(),
            'generateRules' => $this->getGenerateRules(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt()
            ],
            'brand' => $this->getBrand(),
            'country' => $this->getCountry(),
            'rules' => $this->getRules()
        ];
    }

    /**
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $internationalCode
     *
     * @return static
     */
    public function setInternationalCode($internationalCode = null)
    {
        $this->internationalCode = $internationalCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInternationalCode()
    {
        return $this->internationalCode;
    }

    /**
     * @param string $trunkPrefix
     *
     * @return static
     */
    public function setTrunkPrefix($trunkPrefix = null)
    {
        $this->trunkPrefix = $trunkPrefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTrunkPrefix()
    {
        return $this->trunkPrefix;
    }

    /**
     * @param string $areaCode
     *
     * @return static
     */
    public function setAreaCode($areaCode = null)
    {
        $this->areaCode = $areaCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * @param integer $nationalLen
     *
     * @return static
     */
    public function setNationalLen($nationalLen = null)
    {
        $this->nationalLen = $nationalLen;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getNationalLen()
    {
        return $this->nationalLen;
    }

    /**
     * @param boolean $generateRules
     *
     * @return static
     */
    public function setGenerateRules($generateRules = null)
    {
        $this->generateRules = $generateRules;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getGenerateRules()
    {
        return $this->generateRules;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $nameEn
     *
     * @return static
     */
    public function setNameEn($nameEn = null)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs
     *
     * @return static
     */
    public function setNameEs($nameEs = null)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    /**
     * @param string $nameCa
     *
     * @return static
     */
    public function setNameCa($nameCa = null)
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameCa()
    {
        return $this->nameCa;
    }

    /**
     * @param string $nameIt
     *
     * @return static
     */
    public function setNameIt($nameIt = null)
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameIt()
    {
        return $this->nameIt;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $country
     *
     * @return static
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getCountryId()
    {
        if ($dto = $this->getCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $rules
     *
     * @return static
     */
    public function setRules($rules = null)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getRules()
    {
        return $this->rules;
    }
}
