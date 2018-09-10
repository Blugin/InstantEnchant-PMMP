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

abstract class ItemType{
	public const NONE = -1;
	public const SWORD = 0;
	public const TOOL = 1;
	public const ARMOR = 2;
	public const BOW = 3;
	//public const FISHING_ROD = 4;
	//public const TRIDENT = 5;

	/**
	 * @var int[] const of self
	 *             key is item id
	 */
	public static $table = [
		//Sword
		Item::WOODEN_SWORD => self::SWORD,
		Item::STONE_SWORD => self::SWORD,
		Item::IRON_SWORD => self::SWORD,
		Item::GOLD_SWORD => self::SWORD,
		Item::DIAMOND_SWORD => self::SWORD,

		//Tool
		Item::WOODEN_SHOVEL => self::TOOL,
		Item::STONE_SHOVEL => self::TOOL,
		Item::IRON_SHOVEL => self::TOOL,
		Item::GOLD_SHOVEL => self::TOOL,
		Item::DIAMOND_SHOVEL => self::TOOL,

		Item::WOODEN_PICKAXE => self::TOOL,
		Item::STONE_PICKAXE => self::TOOL,
		Item::IRON_PICKAXE => self::TOOL,
		Item::GOLD_PICKAXE => self::TOOL,
		Item::DIAMOND_PICKAXE => self::TOOL,

		Item::WOODEN_AXE => self::TOOL,
		Item::STONE_AXE => self::TOOL,
		Item::IRON_AXE => self::TOOL,
		Item::GOLD_AXE => self::TOOL,
		Item::DIAMOND_AXE => self::TOOL,

		//Armor
		Item::LEATHER_HELMET => self::ARMOR,
		Item::IRON_HELMET => self::ARMOR,
		Item::CHAIN_HELMET => self::ARMOR,
		Item::GOLD_HELMET => self::ARMOR,
		Item::DIAMOND_HELMET => self::ARMOR,

		Item::LEATHER_CHESTPLATE => self::ARMOR,
		Item::IRON_CHESTPLATE => self::ARMOR,
		Item::CHAIN_CHESTPLATE => self::ARMOR,
		Item::GOLD_CHESTPLATE => self::ARMOR,
		Item::DIAMOND_CHESTPLATE => self::ARMOR,

		Item::LEATHER_LEGGINGS => self::ARMOR,
		Item::IRON_LEGGINGS => self::ARMOR,
		Item::CHAIN_LEGGINGS => self::ARMOR,
		Item::GOLD_LEGGINGS => self::ARMOR,
		Item::DIAMOND_LEGGINGS => self::ARMOR,

		Item::LEATHER_BOOTS => self::ARMOR,
		Item::IRON_BOOTS => self::ARMOR,
		Item::CHAIN_BOOTS => self::ARMOR,
		Item::GOLD_BOOTS => self::ARMOR,
		Item::DIAMOND_BOOTS => self::ARMOR,

		//BOW
		Item::BOW => self::BOW
	];

	/**
	 * @param Item $item
	 *
	 * @return int
	 */
	public static function get(Item $item) : int{
		return self::$table[$item->getId()] ?? self::NONE;
	}
}