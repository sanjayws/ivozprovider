<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface BillableCallInterface extends LoggableEntityInterface
{
    const DIRECTION_INBOUND = 'inbound';
    const DIRECTION_OUTBOUND = 'outbound';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function isOutboundCall();

    /**
     * Get callid
     *
     * @return string | null
     */
    public function getCallid();

    /**
     * Get startTime
     *
     * @return \DateTime | null
     */
    public function getStartTime();

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration();

    /**
     * Get caller
     *
     * @return string | null
     */
    public function getCaller();

    /**
     * Get callee
     *
     * @return string | null
     */
    public function getCallee();

    /**
     * Get cost
     *
     * @return float | null
     */
    public function getCost();

    /**
     * Get price
     *
     * @return float | null
     */
    public function getPrice();

    /**
     * Get priceDetails
     *
     * @return array | null
     */
    public function getPriceDetails();

    /**
     * Get carrierName
     *
     * @return string | null
     */
    public function getCarrierName();

    /**
     * Get destinationName
     *
     * @return string | null
     */
    public function getDestinationName();

    /**
     * Get ratingPlanName
     *
     * @return string | null
     */
    public function getRatingPlanName();

    /**
     * Get endpointType
     *
     * @return string | null
     */
    public function getEndpointType();

    /**
     * Get endpointId
     *
     * @return integer | null
     */
    public function getEndpointId();

    /**
     * Get direction
     *
     * @return string | null
     */
    public function getDirection();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();

    /**
     * Get destination
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationInterface | null
     */
    public function getDestination();

    /**
     * Get ratingPlanGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface | null
     */
    public function getRatingPlanGroup();

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface | null
     */
    public function getInvoice();

    /**
     * Get trunksCdr
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface | null
     */
    public function getTrunksCdr();
}
