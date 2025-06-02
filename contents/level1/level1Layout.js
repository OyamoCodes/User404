export function generateeMappings(tileType) {
    return {
        0: () => [
            sprite(`${tileType}-tileset`),
            area(),
            body({ isStatic: true }),
            offscreen()
        ]
    };
}