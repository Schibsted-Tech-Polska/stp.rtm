<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;


class DaoFactory {
    /**
     * Returns a desired DAO object
     * @param string $type DAO class name prefix
     * @throws \Exception
     * @return AbstractDao
     */
    public static function build($type) {
        $dao = __NAMESPACE__ . '\\' . ucfirst($type) . 'Dao';
        if (class_exists($dao)) {
            /**
             * DAO class exists - returning its instance.
             */
            return $dao::getInstance();
        } else {
            /**
             * DAO of needed type does not exist - throwing exception.
             */
            throw new \Exception('Invalid DAO type given.');
        }
    }
}