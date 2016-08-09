<?php
namespace CMS\Helper;

class Role
{
    /**
     * @param $requireRole array|string
     * @param $ownRole     array|string
     *
     * @return bool
     */
    public static function check($ownRole, $requireRole)
    {
        $roles = (array)$requireRole;
        /** Load roles relation */

        $has = false;
        foreach ($roles as $role) {
            /** AND operation */
            if (is_array($role)) {
                $has = $has || count(array_intersect($ownRole, $role)) == count($role);
            } /** OR operation */
            else {
                $has = $has || count(array_intersect($ownRole, (array)$role)) > 0;
            }

            if ($has) break;
        }

        return $has;
    }
}