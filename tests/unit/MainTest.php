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
            'speciality' => 'Аллергология',
            'cityGroup' => [
                'name' => 'новосибирск'
            ]
        ];

        $this->assertEquals(
            'Лучшие аллергологи Новосибирска',
            $module->transform(
                'Лучшие ' .
                '{speciality|map:доктор|morphology:' . StringHelper::MORPHOLOGY_PLURAL_NOMINATIVE . '|strtolower}' .
                ' ' .
                '{cityGroup.name|morphology:' . StringHelper::MORPHOLOGY_GENITIVE . '|ucfirst}',
                $data
            )
        );

    }
}