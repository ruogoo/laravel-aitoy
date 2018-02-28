<?php
/**
 * This file is part of ruogoo.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\AIToy;

use Zttp\Zttp;

class MicrosoftCouplet
{
    const URL_VALID = 'http://duilian.msra.cn/app/CoupletsWS_V2.asmx/IsValidChineseString';
    const URL_COUPLET = 'http://duilian.msra.cn/app/CoupletsWS_V2.asmx/GetXiaLian';

    public function isValid($str): bool
    {
        $json = Zttp::asJson()->post(self::URL_VALID, [
            'inputString' => $str,
        ])->json();

        return array_get($json, 'd', false);
    }

    public function couplet($str): array
    {
        $json     = Zttp::asJson()->post(self::URL_COUPLET, [
            'shanglian'     => $str,
            'xialianLocker' => '00000',
            'isUpdate'      => false,
        ])->json();
        $wellSets = array_get($json, 'd.XialianWellKnownSets');
        if (\is_array($wellSets)) {
            return array_flatten(array_pluck($wellSets, 'XialianCandidates'));
        }

        return [];
    }
}
