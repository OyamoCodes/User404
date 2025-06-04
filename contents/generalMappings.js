
export function generateMappings(tileType) {
    return {
        tileWidth: 16,
        tileHeight: 16,
        0: () => [
            sprite(`${tileType}-tileset`, { anim: "tl" }),
            area(),
            body({ isStatic: true }),
            offscreen(),
        ],
        1: () => [
            sprite(`${tileType}-tileset`, { anim: "tm" }),
            area(),
            body({ isStatic: true }),
            offscreen(),
        ],
        2: () => [
            sprite(`${tileType}-tileset`, { anim: "tr" }),
            area(),
            body({ isStatic: true }),
            offscreen(),
        ],
        3: () => [
            sprite(`${tileType}-tileset`, { anim: "ml" }),
            area(),
            body({ isStatic: true }),
            offscreen(),
        ],
        4: () => [
            sprite(`${tileType}-tileset`, { anim: "mm" }),
            area(),
            body({ isStatic: true }),
            offscreen(),
        ],
        5: () => [
            sprite(`${tileType}-tileset`, { anim: "mr" }),
            area(),
            body({ isStatic: true }),
            offscreen(),
        ],
        6: () => [
            sprite(`${tileType}-tileset`, { anim: "bl" }),
            area(),
            body({ isStatic: true }),
            offscreen(),
        ],
        7: () => [
            sprite(`${tileType}-tileset`, { anim: "bm" }),
            area(),
            body({ isStatic: true }),
            offscreen(),
        ],
        8: () => [
            sprite(`${tileType}-tileset`, { anim: "br" }),
            area(),
            body({ isStatic: true }),
            offscreen(),
        ],
    }
}