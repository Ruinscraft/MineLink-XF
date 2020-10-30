<?php

namespace Ruinscraft\MineLink\Repository;

use XF\Mvc\Entity\AbstractCollection;
use XF\Mvc\Entity\Repository;

class CodeEntry extends Repository {

    public function fetchCodeEntry($code) {
		return $this->finder('Ruinscraft\MineLink:CodeEntry')
			->where('code', $code)
			->fetchOne();
	}

}
