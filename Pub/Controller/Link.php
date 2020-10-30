<?php

namespace Ruinscraft\MineLink\Pub\Controller;

class Link extends \XF\Pub\Controller\AbstractController {

    public function actionIndex() {
        $userId = \XF::visitor()->user_id;

        /* Ensure a user is logged in */
        if (!$userId) {
			return $this->message(\XF::phrase('minelink_must_be_logged_in'));
        }
        
        $code = $_GET['code'];

        // Check code is at least the right length before hitting the database
        // Codes are UUID v4 without -
        // Example: ea6d8c59cee8408490c92c210714e9be
        if (strlen($code) !== 32) {
            return $this->message(\XF::phrase('minelink_invalid_code'));
        }

        $codeRepo = $this->getCodeEntryRepo();
        $codeEntry = $codeRepo->fetchCodeEntry($code);

        if (!$codeEntry) {
            return $this->message(\XF::phrase('minelink_invalid_code'));
        }

        if ($codeEntry->used) {
            return $this->message(\XF::phrase('minelink_invalid_code'));
        }

        $createdTime = $codeEntry->created_date;
        $nowTime = \XF::$time;

        if (($createdTime + 300) < $nowTime) {
            return $this->message(\XF::phrase('minelink_invalid_code'));
        }

        $codeEntry->fastUpdate('used', 1);
        $codeEntry->fastUpdate('user_id', $userId);

        return $this->message(\XF::phrase('minelink_link_success'));
    }

    protected function getCodeEntryRepo() {
		return $this->repository('Ruinscraft\MineLink:CodeEntry');
	}

}
