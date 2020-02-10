<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * FriendAbstract
 * @codeCoverageIgnore
 */
abstract class FriendAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * comment: enum:udp|tcp|tls
     * @var string
     */
    protected $transport;

    /**
     * @var string | null
     */
    protected $ip;

    /**
     * @var integer | null
     */
    protected $port;

    /**
     * column: auth_needed
     * @var string
     */
    protected $authNeeded = 'yes';

    /**
     * @var string | null
     */
    protected $password;

    /**
     * @var integer
     */
    protected $priority = 1;

    /**
     * @var string
     */
    protected $disallow = 'all';

    /**
     * @var string
     */
    protected $allow = 'alaw';

    /**
     * column: direct_media_method
     * comment: enum:invite|update
     * @var string
     */
    protected $directMediaMethod = 'update';

    /**
     * column: callerid_update_header
     * comment: enum:pai|rpid
     * @var string
     */
    protected $calleridUpdateHeader = 'pai';

    /**
     * column: update_callerid
     * comment: enum:yes|no
     * @var string
     */
    protected $updateCallerid = 'yes';

    /**
     * column: from_domain
     * @var string | null
     */
    protected $fromDomain;

    /**
     * comment: enum:yes|no|intervpbx
     * @var string
     */
    protected $directConnectivity = 'yes';

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $ddiIn = 'yes';

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $t38Passthrough = 'no';

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    protected $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    protected $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface | null
     */
    protected $callAcl;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    protected $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    protected $interCompany;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $description,
        $transport,
        $authNeeded,
        $priority,
        $disallow,
        $allow,
        $directMediaMethod,
        $calleridUpdateHeader,
        $updateCallerid,
        $directConnectivity,
        $ddiIn,
        $t38Passthrough
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setTransport($transport);
        $this->setAuthNeeded($authNeeded);
        $this->setPriority($priority);
        $this->setDisallow($disallow);
        $this->setAllow($allow);
        $this->setDirectMediaMethod($directMediaMethod);
        $this->setCalleridUpdateHeader($calleridUpdateHeader);
        $this->setUpdateCallerid($updateCallerid);
        $this->setDirectConnectivity($directConnectivity);
        $this->setDdiIn($ddiIn);
        $this->setT38Passthrough($t38Passthrough);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Friend",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return FriendDto
     */
    public static function createDto($id = null)
    {
        return new FriendDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param FriendInterface|null $entity
     * @param int $depth
     * @return FriendDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FriendInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var FriendDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FriendDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FriendDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getTransport(),
            $dto->getAuthNeeded(),
            $dto->getPriority(),
            $dto->getDisallow(),
            $dto->getAllow(),
            $dto->getDirectMediaMethod(),
            $dto->getCalleridUpdateHeader(),
            $dto->getUpdateCallerid(),
            $dto->getDirectConnectivity(),
            $dto->getDdiIn(),
            $dto->getT38Passthrough()
        );

        $self
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setPassword($dto->getPassword())
            ->setFromDomain($dto->getFromDomain())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setInterCompany($fkTransformer->transform($dto->getInterCompany()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FriendDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FriendDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setAuthNeeded($dto->getAuthNeeded())
            ->setPassword($dto->getPassword())
            ->setPriority($dto->getPriority())
            ->setDisallow($dto->getDisallow())
            ->setAllow($dto->getAllow())
            ->setDirectMediaMethod($dto->getDirectMediaMethod())
            ->setCalleridUpdateHeader($dto->getCalleridUpdateHeader())
            ->setUpdateCallerid($dto->getUpdateCallerid())
            ->setFromDomain($dto->getFromDomain())
            ->setDirectConnectivity($dto->getDirectConnectivity())
            ->setDdiIn($dto->getDdiIn())
            ->setT38Passthrough($dto->getT38Passthrough())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setInterCompany($fkTransformer->transform($dto->getInterCompany()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FriendDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setTransport(self::getTransport())
            ->setIp(self::getIp())
            ->setPort(self::getPort())
            ->setAuthNeeded(self::getAuthNeeded())
            ->setPassword(self::getPassword())
            ->setPriority(self::getPriority())
            ->setDisallow(self::getDisallow())
            ->setAllow(self::getAllow())
            ->setDirectMediaMethod(self::getDirectMediaMethod())
            ->setCalleridUpdateHeader(self::getCalleridUpdateHeader())
            ->setUpdateCallerid(self::getUpdateCallerid())
            ->setFromDomain(self::getFromDomain())
            ->setDirectConnectivity(self::getDirectConnectivity())
            ->setDdiIn(self::getDdiIn())
            ->setT38Passthrough(self::getT38Passthrough())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setDomain(\Ivoz\Provider\Domain\Model\Domain\Domain::entityToDto(self::getDomain(), $depth))
            ->setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAcl::entityToDto(self::getCallAcl(), $depth))
            ->setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setLanguage(\Ivoz\Provider\Domain\Model\Language\Language::entityToDto(self::getLanguage(), $depth))
            ->setInterCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getInterCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'transport' => self::getTransport(),
            'ip' => self::getIp(),
            'port' => self::getPort(),
            'auth_needed' => self::getAuthNeeded(),
            'password' => self::getPassword(),
            'priority' => self::getPriority(),
            'disallow' => self::getDisallow(),
            'allow' => self::getAllow(),
            'direct_media_method' => self::getDirectMediaMethod(),
            'callerid_update_header' => self::getCalleridUpdateHeader(),
            'update_callerid' => self::getUpdateCallerid(),
            'from_domain' => self::getFromDomain(),
            'directConnectivity' => self::getDirectConnectivity(),
            'ddiIn' => self::getDdiIn(),
            't38Passthrough' => self::getT38Passthrough(),
            'companyId' => self::getCompany()->getId(),
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
            'callAclId' => self::getCallAcl() ? self::getCallAcl()->getId() : null,
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null,
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null,
            'interCompanyId' => self::getInterCompany() ? self::getInterCompany()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 65, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return static
     */
    protected function setDescription($description)
    {
        Assertion::notNull($description, 'description value "%s" is null, but non null value was expected.');
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set transport
     *
     * @param string $transport
     *
     * @return static
     */
    protected function setTransport($transport)
    {
        Assertion::notNull($transport, 'transport value "%s" is null, but non null value was expected.');
        Assertion::maxLength($transport, 25, 'transport value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($transport, [
            FriendInterface::TRANSPORT_UDP,
            FriendInterface::TRANSPORT_TCP,
            FriendInterface::TRANSPORT_TLS
        ], 'transportvalue "%s" is not an element of the valid values: %s');

        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set ip
     *
     * @param string $ip | null
     *
     * @return static
     */
    protected function setIp($ip = null)
    {
        if (!is_null($ip)) {
            Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set port
     *
     * @param integer $port | null
     *
     * @return static
     */
    protected function setPort($port = null)
    {
        if (!is_null($port)) {
            Assertion::integerish($port, 'port value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($port, 0, 'port provided "%s" is not greater or equal than "%s".');
            $port = (int) $port;
        }

        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer | null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set authNeeded
     *
     * @param string $authNeeded
     *
     * @return static
     */
    protected function setAuthNeeded($authNeeded)
    {
        Assertion::notNull($authNeeded, 'authNeeded value "%s" is null, but non null value was expected.');

        $this->authNeeded = $authNeeded;

        return $this;
    }

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded()
    {
        return $this->authNeeded;
    }

    /**
     * Set password
     *
     * @param string $password | null
     *
     * @return static
     */
    protected function setPassword($password = null)
    {
        if (!is_null($password)) {
            Assertion::maxLength($password, 64, 'password value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string | null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return static
     */
    protected function setPriority($priority)
    {
        Assertion::notNull($priority, 'priority value "%s" is null, but non null value was expected.');
        Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');

        $this->priority = (int) $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set disallow
     *
     * @param string $disallow
     *
     * @return static
     */
    protected function setDisallow($disallow)
    {
        Assertion::notNull($disallow, 'disallow value "%s" is null, but non null value was expected.');
        Assertion::maxLength($disallow, 200, 'disallow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disallow = $disallow;

        return $this;
    }

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow()
    {
        return $this->disallow;
    }

    /**
     * Set allow
     *
     * @param string $allow
     *
     * @return static
     */
    protected function setAllow($allow)
    {
        Assertion::notNull($allow, 'allow value "%s" is null, but non null value was expected.');
        Assertion::maxLength($allow, 200, 'allow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->allow = $allow;

        return $this;
    }

    /**
     * Get allow
     *
     * @return string
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * Set directMediaMethod
     *
     * @param string $directMediaMethod
     *
     * @return static
     */
    protected function setDirectMediaMethod($directMediaMethod)
    {
        Assertion::notNull($directMediaMethod, 'directMediaMethod value "%s" is null, but non null value was expected.');
        Assertion::choice($directMediaMethod, [
            FriendInterface::DIRECTMEDIAMETHOD_INVITE,
            FriendInterface::DIRECTMEDIAMETHOD_UPDATE
        ], 'directMediaMethodvalue "%s" is not an element of the valid values: %s');

        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod()
    {
        return $this->directMediaMethod;
    }

    /**
     * Set calleridUpdateHeader
     *
     * @param string $calleridUpdateHeader
     *
     * @return static
     */
    protected function setCalleridUpdateHeader($calleridUpdateHeader)
    {
        Assertion::notNull($calleridUpdateHeader, 'calleridUpdateHeader value "%s" is null, but non null value was expected.');
        Assertion::choice($calleridUpdateHeader, [
            FriendInterface::CALLERIDUPDATEHEADER_PAI,
            FriendInterface::CALLERIDUPDATEHEADER_RPID
        ], 'calleridUpdateHeadervalue "%s" is not an element of the valid values: %s');

        $this->calleridUpdateHeader = $calleridUpdateHeader;

        return $this;
    }

    /**
     * Get calleridUpdateHeader
     *
     * @return string
     */
    public function getCalleridUpdateHeader()
    {
        return $this->calleridUpdateHeader;
    }

    /**
     * Set updateCallerid
     *
     * @param string $updateCallerid
     *
     * @return static
     */
    protected function setUpdateCallerid($updateCallerid)
    {
        Assertion::notNull($updateCallerid, 'updateCallerid value "%s" is null, but non null value was expected.');
        Assertion::choice($updateCallerid, [
            FriendInterface::UPDATECALLERID_YES,
            FriendInterface::UPDATECALLERID_NO
        ], 'updateCalleridvalue "%s" is not an element of the valid values: %s');

        $this->updateCallerid = $updateCallerid;

        return $this;
    }

    /**
     * Get updateCallerid
     *
     * @return string
     */
    public function getUpdateCallerid()
    {
        return $this->updateCallerid;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain | null
     *
     * @return static
     */
    protected function setFromDomain($fromDomain = null)
    {
        if (!is_null($fromDomain)) {
            Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * Set directConnectivity
     *
     * @param string $directConnectivity
     *
     * @return static
     */
    protected function setDirectConnectivity($directConnectivity)
    {
        Assertion::notNull($directConnectivity, 'directConnectivity value "%s" is null, but non null value was expected.');
        Assertion::maxLength($directConnectivity, 20, 'directConnectivity value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($directConnectivity, [
            FriendInterface::DIRECTCONNECTIVITY_YES,
            FriendInterface::DIRECTCONNECTIVITY_NO,
            FriendInterface::DIRECTCONNECTIVITY_INTERVPBX
        ], 'directConnectivityvalue "%s" is not an element of the valid values: %s');

        $this->directConnectivity = $directConnectivity;

        return $this;
    }

    /**
     * Get directConnectivity
     *
     * @return string
     */
    public function getDirectConnectivity()
    {
        return $this->directConnectivity;
    }

    /**
     * Set ddiIn
     *
     * @param string $ddiIn
     *
     * @return static
     */
    protected function setDdiIn($ddiIn)
    {
        Assertion::notNull($ddiIn, 'ddiIn value "%s" is null, but non null value was expected.');
        Assertion::choice($ddiIn, [
            FriendInterface::DDIIN_YES,
            FriendInterface::DDIIN_NO
        ], 'ddiInvalue "%s" is not an element of the valid values: %s');

        $this->ddiIn = $ddiIn;

        return $this;
    }

    /**
     * Get ddiIn
     *
     * @return string
     */
    public function getDdiIn()
    {
        return $this->ddiIn;
    }

    /**
     * Set t38Passthrough
     *
     * @param string $t38Passthrough
     *
     * @return static
     */
    protected function setT38Passthrough($t38Passthrough)
    {
        Assertion::notNull($t38Passthrough, 't38Passthrough value "%s" is null, but non null value was expected.');
        Assertion::choice($t38Passthrough, [
            FriendInterface::T38PASSTHROUGH_YES,
            FriendInterface::T38PASSTHROUGH_NO
        ], 't38Passthroughvalue "%s" is not an element of the valid values: %s');

        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    /**
     * Get t38Passthrough
     *
     * @return string
     */
    public function getT38Passthrough()
    {
        return $this->t38Passthrough;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain | null
     *
     * @return static
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet | null
     *
     * @return static
     */
    protected function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set callAcl
     *
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl | null
     *
     * @return static
     */
    protected function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl = null)
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface | null
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi | null
     *
     * @return static
     */
    protected function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language | null
     *
     * @return static
     */
    protected function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set interCompany
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $interCompany | null
     *
     * @return static
     */
    protected function setInterCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $interCompany = null)
    {
        $this->interCompany = $interCompany;

        return $this;
    }

    /**
     * Get interCompany
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getInterCompany()
    {
        return $this->interCompany;
    }

    // @codeCoverageIgnoreEnd
}
