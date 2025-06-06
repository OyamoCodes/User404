
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
            pos(200, -150),
            area(),
            color(255, 255, 255), 
            "interactable",
        ],
    }
}