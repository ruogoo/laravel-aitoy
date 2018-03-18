<?php
/**
 * This file is part of ruogoo.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

namespace Ruogoo\AIToy;

use GuzzleHttp\Client;

class MicrosoftCouplet
{
    const URL_VALID = 'http://duilian.msra.cn/app/CoupletsWS_V2.asmx/IsValidChineseString';
    const URL_COUPLET = 'http://duilian.msra.cn/app/CoupletsWS_V2.asmx/GetXiaLian';

    public function isValid($str): bool
    {
        $json = $this->request(self::URL_VALID, ['inputString' => $str]);

        return array_get($json, 'd', false);
    }

    public function couplet($str): array
    {
        $json = $this->request(self::URL_COUPLET, [
            'shanglian'     => $str,
            'xialianLocker' => str_repeat('0', mb_strlen($str)),
            'isUpdate'      => false,
        ]);

        $wellSets = array_get($json, 'd.XialianWellKnownSets', array_get($json, 'd.XialianSystemGeneratedSets'));
        if (\is_array($wellSets)) {
            return array_flatten(array_pluck($wellSets, 'XialianCandidates'));
        }

        return [];
    }

    private function request(string $url, array $params): array
    {
        $client          = new Client();
        $responseContent = $client->post(url, [
            'form_params' => $params,
        ])->getBody()->getContents();

        $json = json_decode($responseContent, true);

        return $json;
    }
}
