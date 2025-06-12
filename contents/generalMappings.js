
export function generateMappings(tileType) {
    return {
        "=": () => [
            rect(1200, 100),
            color(127, 200, 80),
            area(),
            body({ isStatic: true }),
        ],
        " ": () => [],
        "n": () => [
            sprite("player", { anim: "idle" }),
            scale(0.7),
            pos(300, -150), 
            area({ width: 50, height: 80 }),
            "npc",
            { npcId: "dummy" },
        ],
        "ç": () => [
            sprite("wXP_Trash"),
            scale(0.7),
        ],

    }
}