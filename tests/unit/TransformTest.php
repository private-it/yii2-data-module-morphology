<?php
namespace PrivateIT\modules\morphology\tests\unit;

use PrivateIT\modules\morphology\components\StringHelper;
use PrivateIT\modules\morphology\models\Dic;
use PrivateIT\modules\morphology\MorphologyModule;
use PrivateIT\modules\morphology\tests\DbTestCase;

class TransformTest extends DbTestCase
{
    public function testMe()
    {
        $module = MorphologyModule::getInstance();
        $data = [
            'speciality' => 'Аллерголог',
            'cityGroup' => [
                'name' => 'новосибирск'
            ]
        ];

        $this->assertEquals(
            'Лучшие аллергологи Новосибирска',
            $module->transform(
                'Лучшие ' .
                '{speciality|morphology:' . StringHelper::MORPHOLOGY_PLURAL_NOMINATIVE . '|strtolower}' .
                ' ' .
                '{cityGroup.name|morphology:' . StringHelper::MORPHOLOGY_GENITIVE . '|ucfirst}',
                $data
            )
        );

    }
}