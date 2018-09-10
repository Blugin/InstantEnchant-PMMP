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
use pocketmine\item\Item;

abstract class EnchantmentType{
	/**
	 * @var int[][]
	 *       [item type => enchantment id[]]
	 *
	 * According to https://minecraft.gamepedia.com/Tutorials/Enchantment_mechanics#Step_three_-_Select_a_set_of_enchantments_from_the_list
	 */
	public static $table = [
		ItemType::ARMOR => [ //Armor Enchantments
			Enchantment::PROTECTION,
			Enchantment::FEATHER_FALLING,
			Enchantment::FIRE_PROTECTION,
			Enchantment::PROJECTILE_PROTECTION,
			Enchantment::AQUA_AFFINITY,
			Enchantment::BLAST_PROTECTION,
			Enchantment::RESPIRATION,
			Enchantment::DEPTH_STRIDER,
			//is Treasure// Enchantment::FROST_WALKER
			Enchantment::THORNS
			//is not exists// Curse of Binding
		],

		ItemType::SWORD => [ //Sword Enchantments
			Enchantment::SHARPNESS,
			Enchantment::BANE_OF_ARTHROPODS,
			Enchantment::KNOCKBACK,
			Enchantment::SMITE,
			Enchantment::FIRE_ASPECT,
			Enchantment::LOOTING
			//is not exists// Sweeping Edge
		],

		ItemType::TOOL => [ //Tool Enchantments
			Enchantment::EFFICIENCY,
			Enchantment::FORTUNE,
			Enchantment::SILK_TOUCH
		],

		ItemType::BOW => [ //Bow Enchantments
			Enchantment::POWER,
			Enchantment::FLAME,
			Enchantment::PUNCH,
			Enchantment::INFINITY
		],

		/*
		ItemType::FISHING_ROD => [ //Fishing Rod Enchantments
			Enchantment::LUCK_OF_THE_SEA,
			Enchantment::LURE
		],
		*/

		/*
		ItemType::TRIDENT => [ //Trident Enchantments
			//is not possible// Enchantment::CHANNELING
		],
		*/

		ItemType::NONE => [ //"Anything" Enchantments
			Enchantment::UNBREAKING
			//is Treasure// Enchantment::MENDING
			//is not exists// Curse of Vanishing
		]
	];

	/**
	 * @param Item $item
	 *
	 * @return int[]
	 */
	public static function get(Item $item) : array{
		return array_merge(self::$table[ItemType::get($item)] ?? [], self::$table[ItemType::NONE]);
	}
}