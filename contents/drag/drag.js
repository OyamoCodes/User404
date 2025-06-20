// contents/dragTest/dragTestGame.js
export function startDragTest() {
    add([
        sprite("wood_bg"),
        scale(2),
    ])
    const target = add([
        rect(100, 100),
        pos(500, 300),
        color(0, 1, 0),
        outline(2),
        area(),
        "target"
    ]);

    const draggable = add([
        sprite("ram_stick"),
        scale(0.2),
        pos(100, 100),
        outline(2),
        area(),
        "draggable"
    ]);

    let isDragging = false;

    draggable.onClick(() => {
        isDragging = true;
    });

    onMouseRelease(() => {
        if (isDragging) {
            isDragging = false;

            if (draggable.isColliding(target)) {
                draggable.color = rgb(0, 0.7, 0);
                add([
                    text("Sucesso!", { size: 32 }),
                    pos(200, 50),
                ]);
            } else {
                draggable.color = rgb(1, 0, 0);
            }
        }
    });

    onUpdate(() => {
        if (isDragging) {
            draggable.pos = mousePos().sub(vec2(draggable.width / 2, draggable.height / 2));
        }
    });
}
