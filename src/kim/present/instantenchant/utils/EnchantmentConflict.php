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

abstract class EnchantmentConflict{

	/**
	 * @var int[][]
	 *       [enchantment id => enchantment id[]]
	 *
	 * According to https://minecraft.gamepedia.com/Tutorials/Enchantment_mechanics#Conflicting_enchantments
	 */
	public static $table = [
		//All protection enchantments except Feather Falling conflict with each other, so an item can only have one at a time.
		Enchantment::PROTECTION => [
			Enchantment::FIRE_PROTECTION,
			Enchantment::PROJECTILE_PROTECTION,
			Enchantment::BLAST_PROTECTION
		],
		Enchantment::FIRE_PROTECTION => [
			Enchantment::PROTECTION,
			Enchantment::PROJECTILE_PROTECTION,
			Enchantment::BLAST_PROTECTION
		],
		Enchantment::PROJECTILE_PROTECTION => [
			Enchantment::PROTECTION,
			Enchantment::FIRE_PROTECTION,
			Enchantment::BLAST_PROTECTION
		],
		Enchantment::BLAST_PROTECTION => [
			Enchantment::PROTECTION,
			Enchantment::FIRE_PROTECTION,
			Enchantment::PROJECTILE_PROTECTION
		],

		//All damage enchantments (Sharpness, Smite, and Bane of Arthropods) conflict with each other.
		Enchantment::SHARPNESS => [
			Enchantment::SMITE,
			Enchantment::BANE_OF_ARTHROPODS
		],
		Enchantment::SMITE => [
			Enchantment::SHARPNESS,
			Enchantment::BANE_OF_ARTHROPODS
		],
		Enchantment::BANE_OF_ARTHROPODS => [
			Enchantment::SHARPNESS,
			Enchantment::SMITE
		],

		//Depth Strider and Frost Walker conflict with each other.


		//Silk Touch and Fortune conflict with each other.
		Enchantment::FORTUNE => [
			Enchantment::SILK_TOUCH
		],
		Enchantment::SILK_TOUCH => [
			Enchantment::FORTUNE
		],

		//Mending and Infinity conflict with each other.
	];

	/**
	 * @param int $enchantmentId
	 *
	 * @return int[]
	 */
	public static function get(int $enchantmentId) : array{
		$list = self::$table[$enchantmentId] ?? [];
		$list[] = $enchantmentId;
		return $list;
	}
}