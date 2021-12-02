<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\CustomNormalizer;
use Symfony\Component\Serializer\Normalizer\DateIntervalNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeZoneNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Normalizer\UidNormalizer;
use Symfony\Component\Serializer\Serializer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Serializer::class, function() {
            $normalizers = [
                new CustomNormalizer(),
                new DateIntervalNormalizer(),
                new DateTimeNormalizer(),
                new DateTimeZoneNormalizer(),
                new UidNormalizer(),
                new PropertyNormalizer(),
                new ObjectNormalizer(),
            ];
            $encoders = [
                new XmlEncoder(),
                new JsonEncoder(),
                new YamlEncoder(),
                new CsvEncoder(),
            ];
            return new Serializer($normalizers, $encoders);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
