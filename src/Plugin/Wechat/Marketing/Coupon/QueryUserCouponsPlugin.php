<?php

declare(strict_types=1);

namespace Yansongda\Pay\Plugin\Wechat\Marketing\Coupon;

use Yansongda\Pay\Exception\InvalidParamsException;
use Yansongda\Pay\Plugin\Wechat\GeneralPlugin;
use Yansongda\Pay\Rocket;

class QueryUserCouponsPlugin extends GeneralPlugin
{
    protected function doSomething(Rocket $rocket): void
    {
        $rocket->setPayload(null);
    }

    /**
     * @throws \Yansongda\Pay\Exception\InvalidParamsException
     */
    protected function getUri(Rocket $rocket): string
    {
        $payload = $rocket->getPayload();

        if (is_null($payload->get('openid'))) {
            throw new InvalidParamsException(InvalidParamsException::MISSING_NECESSARY_PARAMS);
        }

        $query = $payload->all();
        unset($query['openid']);

        return 'v3/marketing/favor/users/'.
            $payload->get('openid').
            '/coupons?'.http_build_query($query);
    }
}
