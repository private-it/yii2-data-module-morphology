<?php
namespace PrivateIT\modules\morphology\tests\unit;

use PrivateIT\modules\morphology\components\StringHelper;
use PrivateIT\modules\morphology\MorphologyModule;
use PrivateIT\modules\morphology\tests\DbTestCase;
use PrivateIT\modules\morphology\tests\fixtures\application\DicFixture;
use PrivateIT\modules\morphology\tests\fixtures\application\MapFixture;

class MainTest extends DbTestCase
{
    public function fixtures()
    {
        return [
            DicFixture::className(),
            MapFixture::className()
        ];
    }

    public function testMe()
    {
        $module = MorphologyModule::getInstance();
        $data = [
            'speciality' => [
                'name' => 'Аллергология'
            ],
            'district' => [
                'name' => 'Советский'
            ],
            'app' => [
                'data' => [
                    'cityGroup' => [
                        'name' => 'новосибирск'
                    ]
                ]
            ]
        ];

        $pattern = 'Лучшие ' .
            '{speciality.name|map:доктор|morphology:plural_nominative|strtolower}' .
            ' ' .
            '{app.data.cityGroup.name|morphology:genitive|ucfirst}';
        $this->assertEquals(
            'Лучшие аллергологи Новосибирска',
            $module->transform($pattern, $data)
        );

        $pattern = '{speciality.name|map:доктор|morphology:plural_nominative}' .
            ' {district.name|morphology:genitive}' .
            ' {district.name|map:геоТип:0|ifEmpty:Район: |morphology:genitive:0|strtolower}' .
            ' {district.name|map:геоТип:0|ifEmpty:@app.data.cityGroup.name: |morphology:genitive:0}';
        print_r($pattern);
        $this->assertEquals(
            'Аллергологи Советского района Новосибирска',
            $module->transform($pattern, $data)
        );
        $data['district']['name'] = 'Бердск';
        $this->assertEquals(
            'Аллергологи Бердска',
            $module->transform($pattern, $data)
        );
        $this->assertEquals(
            'Feb 15, 2015',
            $module->transform('{date|asDate}', ['date' => '15.02.2015 15:23:17'])
        );
        $this->assertEquals(
            'Feb 15, 2015, 3:23:17 PM',
            $module->transform('{date|asDateTime}', ['date' => '15.02.2015 15:23:17'])
        );
        $this->assertEquals(
            '¤180,005.00',
            $module->transform('{money|asCurrency}', ['money' => '180005'])
        );

    }
}