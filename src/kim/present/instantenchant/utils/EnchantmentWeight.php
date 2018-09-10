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

abstract class EnchantmentWeight{
	/**
	 * @var int[]
	 *       [enchantment id => weight]
	 *
	 * According to https://minecraft.gamepedia.com/Tutorials/Enchantment_mechanics#Step_three_-_Select_a_set_of_enchantments_from_the_list
	 */
	public static $table = [
		//Armor Enchantments weight
		Enchantment::PROTECTION => 10,
		Enchantment::FEATHER_FALLING => 5,
		Enchantment::FIRE_PROTECTION => 5,
		Enchantment::PROJECTILE_PROTECTION => 5,
		Enchantment::AQUA_AFFINITY => 2,
		Enchantment::BLAST_PROTECTION => 2,
		Enchantment::RESPIRATION => 2,
		Enchantment::DEPTH_STRIDER => 2,
		Enchantment::FROST_WALKER => 2,
		Enchantment::THORNS => 1,
		//is not exists// Curse of Binding => 1

		//Sword Enchantments weight
		Enchantment::SHARPNESS => 10,
		Enchantment::BANE_OF_ARTHROPODS => 5,
		Enchantment::KNOCKBACK => 5,
		Enchantment::SMITE => 5,
		Enchantment::FIRE_ASPECT => 2,
		Enchantment::LOOTING => 2,
		//is not exists// Sweeping Edge => 2

		//Tool Enchantments weight
		Enchantment::EFFICIENCY => 10,
		Enchantment::FORTUNE => 2,
		Enchantment::SILK_TOUCH => 1,

		//Bow Enchantments weight
		Enchantment::POWER => 10,
		Enchantment::FLAME => 2,
		Enchantment::PUNCH => 2,
		Enchantment::INFINITY => 1,

		//Fishing Rod Enchantments weight
		Enchantment::LUCK_OF_THE_SEA => 2,
		Enchantment::LURE => 2,

		//Trident Enchantments
		//is not possible// Enchantment::CHANNELING => ?

		//"Anything" Enchantments
		Enchantment::UNBREAKING => 5,
		Enchantment::MENDING => 2
		//is not exists// Curse of Vanishing => 1
	];

	/**
	 * @param int $enchantmentId
	 *
	 * @return int
	 */
	public static function get(int $enchantmentId) : int{
		return self::$table[$enchantmentId] ?? 0;
	}

	/**
	 * @param int[] $enchantments
	 *
	 * @return int[]
	 */
	public static function toWeightTable(array $enchantments) : array{
		$weightTable = [];
		foreach($enchantments as $key => $enchantmentId){
			for($i = 0, $max = self::get($enchantmentId); $i < $max; ++$i){
				$weightTable[] = $enchantmentId;
			}
		}
		return $weightTable;
	}
}