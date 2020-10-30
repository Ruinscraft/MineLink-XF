<?php

namespace Ruinscraft\MineLink\Entity;

use XF\Mvc\Entity\Structure;

class CodeEntry extends \XF\Mvc\Entity\Entity {

	public static function getStructure(Structure $structure) {
		$structure->table = 'minelink_codes';
		$structure->shortName = 'Ruinscraft\MineLink:CodeEntry';
		$structure->primaryKey = 'code';
		$structure->columns = [
			'code' =>					['type' => self::STR, 'required' => true],
			'created_date' =>			['type' => self::UINT, 'required' => true, 'default' => \XF::$time],
			'used' =>					['type' => self::UINT, 'required' => true, 'default' => 0],
			'user_id' =>				['type' => self::UINT, 'required' => true, 'default' => 0]
		];

		return $structure;
	}

	protected function setupApiResultData(\XF\Api\Result\EntityResult $result, $verbosity = self::VERBOSITY_NORMAL, array $options = []) {
		$result->code = $this->code;
		$result->created_date = $this->created_date;
		$result->used = $this->used;
		$result->user_id = $this->user_id;
	}

}
