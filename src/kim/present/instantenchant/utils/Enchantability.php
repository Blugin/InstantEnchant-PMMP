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

namespace kim\present\instantenchant\utils;

use pocketmine\item\Item;

abstract class Enchantability{
	/**
	 * @var int[][]
	 *       [material => [item type => enchantability]]
	 *
	 * According to https://minecraft.gamepedia.com/Tutorials/Enchantment_mechanics#Step_one_-_Applying_modifiers_to_the_enchantment_level
	 */
	public static $table = [
		Material::WOOD => [
			ItemType::SWORD => 15,
			ItemType::TOOL => 15
		],

		Material::LEATHER => [
			ItemType::ARMOR => 15
		],

		Material::STONE => [
			ItemType::SWORD => 5,
			ItemType::TOOL => 5
		],

		Material::IRON => [
			ItemType::ARMOR => 9,

			ItemType::SWORD => 14,
			ItemType::TOOL => 14
		],

		Material::CHAIN => [
			ItemType::ARMOR => 12
		],

		Material::GOLD => [
			ItemType::ARMOR => 25,

			ItemType::SWORD => 14,
			ItemType::TOOL => 14
		],

		Material::DIAMOND => [
			ItemType::ARMOR => 10,

			ItemType::SWORD => 10,
			ItemType::TOOL => 10
		]
	];

	/**
	 * @param Item $item
	 *
	 * @return int
	 */
	public static function get(Item $item) : int{
		$enchantabilities = self::$table[Material::get($item)] ?? null;
		if($enchantabilities !== null){
			return $enchantabilities[ItemType::get($item)] ?? 0;
		}
		return 0;
	}

	/**
	 * @param Item $item
	 *
	 * @return int
	 *
	 * According to https://minecraft.gamepedia.com/Tutorials/Enchantment_mechanics#Step_1_pseudocode
	 */
	public static function getRandomized(Item $item) : int{
		$enchantability = self::get($item);
		$rand_enchantability = 1 + mt_rand(0, (int) ($enchantability / 2) + 1) + mt_rand(0, (int) ($enchantability / 2) + 1);
		$k = $rand_enchantability + 30;
		$rand_bonus_percent = (mt_rand() / mt_getrandmax() + mt_rand() / mt_getrandmax() - 1) * 0.25;
		return (int) ((float) $k * (1.0 + $rand_bonus_percent) + 0.5);
	}
}