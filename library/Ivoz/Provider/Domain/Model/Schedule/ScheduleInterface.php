<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface ScheduleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Check if current time is inside Schedule
     *
     * @param \DateTime $time Current time in Client's Timezone
     * @return bool
     */
    public function isOnSchedule(\DateTime $time);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get timeIn
     *
     * @return \DateTime
     */
    public function getTimeIn();

    /**
     * Get timeout
     *
     * @return \DateTime
     */
    public function getTimeout();

    /**
     * Get monday
     *
     * @return boolean | null
     */
    public function getMonday();

    /**
     * Get tuesday
     *
     * @return boolean | null
     */
    public function getTuesday();

    /**
     * Get wednesday
     *
     * @return boolean | null
     */
    public function getWednesday();

    /**
     * Get thursday
     *
     * @return boolean | null
     */
    public function getThursday();

    /**
     * Get friday
     *
     * @return boolean | null
     */
    public function getFriday();

    /**
     * Get saturday
     *
     * @return boolean | null
     */
    public function getSaturday();

    /**
     * Get sunday
     *
     * @return boolean | null
     */
    public function getSunday();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();
}
