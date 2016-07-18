<?php
namespace Dashboard\Model;

final class Utils
{
    /**
     * Date format used across application
     *
     * @var string
     */
    const DATE_FORMAT = 'Y-m-d';

    /**
     * Date with time format used across application
     *
     * @var string
     */
    const DATE_FORMAT_FULL = 'Y-m-d H:i:s';

    /**
     * Convert Unix timestamp to date string according to given $format.
     * GMT time can be used optionally.
     *
     * @param integer $timestamp
     * @param string $format
     * @param boolean $useGmt
     * @return string
     */
    final public static function timestampToDate($timestamp, $format = self::DATE_FORMAT_FULL, $useGmt = false)
    {
        return $useGmt ? gmdate($format, $timestamp) : date($format, $timestamp);
    }

    /**
     * Convert date string to Unix timestamp, but including local time offset.
     * Time can be reset optionally.
     *
     * @param string $dateToPrepare
     * @param boolean $resetTime
     * @return integer
     */
    final public static function dateStringToLocalSeconds($dateToPrepare, $resetTime = false)
    {
        try {
            $gmtDate = self::dateStringToDate($dateToPrepare, $resetTime);
        } catch (\Exception $e) {
            $gmtDate = new \DateTime(null, new \DateTimeZone('Europe/London'));
        }

        $localDate = clone $gmtDate;
        $localDate->setTimezone(new \DateTimeZone(date_default_timezone_get()));

        return strtotime($dateToPrepare) +
            strtotime(self::formatDate($localDate)) - strtotime(self::formatDate($gmtDate));
    }

    /**
     * Format date time object according to given $format.
     *
     * @param \DateTime $dateTime
     * @param string $format
     * @return string
     */
    final public static function formatDate(\DateTime $dateTime, $format = self::DATE_FORMAT_FULL)
    {
        return $dateTime->format($format);
    }

    /**
     * Convert date string to date time object.
     * Time can be reset optionally.
     * Creates current date if date string is unrecognizable.
     *
     * @param string $dateToPrepare
     * @param boolean $resetTime
     * @return \DateTime
     */
    final public static function dateStringToDate($dateToPrepare, $resetTime = false)
    {
        try {
            $date = new \DateTime($dateToPrepare, new \DateTimeZone('Europe/London'));
            $date = $resetTime ? $date->setTime(0, 0, 0) : $date;
        } catch (\Exception $e) {
            $date = new \DateTime();
        }

        return $date;
    }
}
