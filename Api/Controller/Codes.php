<?php

namespace Ruinscraft\MineLink\Api\Controller;

use XF\Mvc\Entity\Entity;
use XF\Mvc\ParameterBag;

class Codes extends \XF\Api\Controller\AbstractController {

    public function actionGet(ParameterBag $params) {
        $code = $params->code;
        $codeRepo = $this->getCodeEntryRepo();
        $codeEntry = $codeRepo->fetchCodeEntry($code);
        $result = [];

        if (!$codeEntry) {
            return $this->apiResult($result);
        }

		$result = [
			'code' => $codeEntry->toApiResult(Entity::VERBOSITY_VERBOSE)
		];

        return $this->apiResult($result);
    }

    public function actionPut(ParameterBag $params) {
        $code = $params->code;
        $codeRepo = $this->getCodeEntryRepo();
        $codeEntry = $codeRepo->fetchCodeEntry($code);

        if ($codeEntry) {
            return $this->apiError("Code already exists", "code_already_exists");
        }

        $codeEntry = $this->em()->create('Ruinscraft\MineLink:CodeEntry');
        $codeEntry->code = $code;
        $codeEntry->save();

        return $this->apiSuccess();
    }

    protected function getCodeEntryRepo() {
		return $this->repository('Ruinscraft\MineLink:CodeEntry');
	}

}
