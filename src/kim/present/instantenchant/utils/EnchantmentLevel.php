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

use pocketmine\item\enchantment\Enchantment;

abstract class EnchantmentLevel{
	/**
	 * @var Range[][]
	 *       [enchantment id => Range[]]
	 *
	 * According to https://minecraft.gamepedia.com/Enchanting/Levels
	 */
	public static $table;

	private static function init(){
		self::$table = [
			//Armor Enchantments weight
			Enchantment::PROTECTION => [
				new Range(1, 21),
				new Range(12, 32),
				new Range(23, 43),
				new Range(34, 54)
			],
			Enchantment::FEATHER_FALLING => [
				new Range(5, 15),
				new Range(11, 21),
				new Range(17, 27),
				new Range(23, 33)
			],
			Enchantment::FIRE_PROTECTION => [
				new Range(10, 22),
				new Range(18, 30),
				new Range(26, 38),
				new Range(34, 46)
			],
			Enchantment::PROJECTILE_PROTECTION => [
				new Range(3, 18),
				new Range(9, 24),
				new Range(15, 30),
				new Range(21, 36)
			],
			Enchantment::AQUA_AFFINITY => [
				new Range(1, 41)
			],
			Enchantment::BLAST_PROTECTION => [
				new Range(5, 17),
				new Range(13, 25),
				new Range(21, 33),
				new Range(29, 41)
			],
			Enchantment::RESPIRATION => [
				new Range(10, 40),
				new Range(20, 50),
				new Range(30, 60)
			],
			Enchantment::DEPTH_STRIDER => [
				new Range(10, 25),
				new Range(20, 35),
				new Range(30, 45)
			],
			//is Treasure// Enchantment::FROST_WALKER => []
			Enchantment::THORNS => [
				new Range(10, 60),
				new Range(30, 80),
				new Range(50, 100)
			],
			//is not exists// Curse of Binding => []

			//Sword Enchantments weight
			Enchantment::SHARPNESS => [
				new Range(1, 21),
				new Range(12, 32),
				new Range(23, 43),
				new Range(24, 54),
				new Range(45, 65)
			],
			Enchantment::BANE_OF_ARTHROPODS => [
				new Range(5, 25),
				new Range(13, 33),
				new Range(21, 41),
				new Range(29, 49),
				new Range(37, 57)
			],
			Enchantment::KNOCKBACK => [
				new Range(5, 55),
				new Range(25, 75)
			],
			Enchantment::SMITE => [
				new Range(5, 25),
				new Range(13, 33),
				new Range(21, 41),
				new Range(29, 49),
				new Range(37, 57)
			],
			Enchantment::FIRE_ASPECT => [
				new Range(10, 60),
				new Range(30, 80)
			],
			Enchantment::LOOTING => [
				new Range(15, 65),
				new Range(24, 74),
				new Range(33, 83)
			],
			//is not exists// Sweeping Edge => []

			//Tool Enchantments weight
			Enchantment::EFFICIENCY => [
				new Range(1, 51),
				new Range(11, 61),
				new Range(21, 71),
				new Range(31, 81),
				new Range(41, 91)
			],
			Enchantment::FORTUNE => [
				new Range(15, 65),
				new Range(24, 74),
				new Range(33, 83)
			],
			Enchantment::SILK_TOUCH => [
				new Range(15, 65)
			],

			//Bow Enchantments weight
			Enchantment::POWER => [
				new Range(1, 16),
				new Range(11, 26),
				new Range(21, 36),
				new Range(31, 46),
				new Range(41, 56)
			],
			Enchantment::FLAME => [
				new Range(20, 50)
			],
			Enchantment::PUNCH => [
				new Range(12, 37),
				new Range(35, 57)
			],
			Enchantment::INFINITY => [
				new Range(20, 50)
			],

			//Fishing Rod Enchantments weight
			Enchantment::LUCK_OF_THE_SEA => [
				new Range(15, 65),
				new Range(24, 74),
				new Range(33, 83)
			],
			Enchantment::LURE => [
				new Range(15, 65),
				new Range(24, 74),
				new Range(33, 83)
			],

			//Trident Enchantments
			//is not possible// Enchantment::CHANNELING => []

			//"Anything" Enchantments
			Enchantment::UNBREAKING => [
				new Range(5, 55),
				new Range(13, 63),
				new Range(1, 71)
			]
			//is Treasure// Enchantment::MENDING => []
			//is not exists// Curse of Vanishing => []
		];
	}

	/**
	 * @param int $enchantmentId
	 *
	 * @param int $randomizedEnchantability
	 *
	 * @return int
	 */
	public static function get(int $enchantmentId, int $randomizedEnchantability) : int{
		if(self::$table === null){
			self::init();
		}
		$ranges = self::$table[$enchantmentId] ?? null;
		if($ranges !== null){
			$level = 0;
			foreach($ranges as $key => $range){
				if($range->include($randomizedEnchantability) && $level <= $key){
					$level = $key + 1;
				}
			}
			return $level;
		}
		return 0;
	}
}