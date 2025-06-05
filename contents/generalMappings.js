
export function generateMappings(tileType) {
    return {
        "=": () => [
            rect(64, 64),
            color(127, 200, 80),
            area(),
            body({ isStatic: true }),
        ],
        " ": () => [],
    }
}