<?php

namespace App;


class Helper
{

    public static function memberType($type)
    {
        switch ($type) {
            case "professor" :
                return trans('trs.professor');
            case "student" :
                return trans('trs.student');
            case "staff" :
                return trans('trs.staff');
        }
        return trans('trs.unknown');
    }

    public static function genderToTranslated($gender)
    {
        switch ($gender) {
            case "male" :
                return trans('trs.male');
            case "female" :
                return trans('trs.female');
        }
        return trans('trs.unknown');
    }

    public static function supportStatusToTranslated($status)
    {
        switch ($status) {
            case "pending" :
                return trans('trs.pending');
            case "answered" :
                return trans('trs.answered');
            case "closed" :
                return trans('trs.closed');
        }
        return trans('trs.unknown');

    }

    public static function productStatusTotranslated($status)
    {
        switch ($status) {
            case "pending" :
                return trans('trs.pending');
            case "accepted" :
                return trans('trs.accepted');
            case "rejected" :
                return trans('trs.rejected');
        }
        return trans('trs.unknown');
    }

}
