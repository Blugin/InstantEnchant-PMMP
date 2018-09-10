<?php

/*
 *
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License. see <https://opensource.org/licenses/MIT>.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://opensource.org/licenses/MIT MIT License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\instantenchant\block;

use kim\present\instantenchant\utils\{
	Enchantability, EnchantmentConflict, EnchantmentLevel, EnchantmentType, EnchantmentWeight
};
use pocketmine\block\{
	BlockFactory, EnchantingTable
};
use pocketmine\item\enchantment\{
	Enchantment, EnchantmentInstance
};
use pocketmine\item\Item;
use pocketmine\Player;

class InstantEnchantingTable extends EnchantingTable{
	/**
	 * Initializes the instant enchanting table.
	 * Register instant enchanting table to block factory.
	 */
	public static function init() : void{
		BlockFactory::registerBlock(new InstantEnchantingTable(), true);
	}

	/**
	 * @param Item        $item
	 * @param Player|null $player
	 *
	 * @return bool
	 */
	public function onActivate(Item $item, Player $player = null) : bool{
		if($player instanceof Player && !$item->hasEnchantments()){
			$availableEnchantments = EnchantmentType::get($item);
			if(empty($availableEnchantments)){
				return true;
			}

			$newItem = clone $item;
			$newItem->count = 1;
			--$item->count;

			$inventory = $player->getInventory();
			if(!$player->isCreative(true)){
				//Requires level 30.
				if($player->getXpLevel() < 30){
					$player->sendMessage("[InstantEnchant] Requires level 30");
					return true;
				}
				//Remove level 30
				$player->setXpLevel($player->getXpLevel() - 30);

				//Requires 30 lapis lazuli
				$lapisLazuli = Item::get(Item::DYE, 4);
				$count = 0;
				foreach($inventory->getContents() as $key => $content){
					if($content->equals($lapisLazuli, true, true)){
						$count += $content->count;
						if($count <= 30){
							break;
						}
					}
				}
				if($count < 30){
					$player->sendMessage("[InstantEnchant] Requires 30 lapis lazuli");
					return true;
				}

				//Remove 30 lapis lazuli
				$count = 30;
				foreach($inventory->getContents(true) as $slot => $content){
					if($content->equals($lapisLazuli, true, true)){
						if($content->count >= $count){
							$content->count -= $count;
							$count = 0;
							$inventory->setItem($slot, $content);
						}else{
							$count -= $content->count;
							$inventory->clear($slot);
						}
						if($count <= 0){
							break;
						}
					}
				}
			}

			$probability = 1;
			while(!empty($availableEnchantments) && mt_rand() / mt_getrandmax() <= $probability){
				$weightTable = EnchantmentWeight::toWeightTable($availableEnchantments);

				$enchantment = Enchantment::getEnchantment($weightTable[array_rand($weightTable)]);
				$enchantability = Enchantability::getRandomized($newItem);
				$enchantLevel = EnchantmentLevel::get($enchantment->getId(), $enchantability);
				if($enchantment !== null && $enchantLevel > 0){
					$newItem->addEnchantment(new EnchantmentInstance($enchantment, $enchantLevel));
					$availableEnchantments = array_diff($availableEnchantments, EnchantmentConflict::get($enchantment->getId()));

					$modifiedEnchantmentLevel = (30 + rand(0, (int) ($enchantability / 4)) + rand(0, (int) ($enchantability / 4)) + 1);
					$probability = $modifiedEnchantmentLevel / 50;
				}
			}
			if($newItem->hasEnchantments()){
				$inventory->addItem($newItem);
			}
		}
		return true;
	}
}
