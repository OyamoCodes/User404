
export function startDragTest() {
    add([
        sprite("wood_bg"),
        scale(2),
    ]);

    const target = add([
        rect(100, 100),
        pos(500, 300),
        outline(2, rgb(255, 0, 0)), // cor do contorno
        area(),
        "target"
    ]);  b
    

    const draggable = add([
        sprite("ram_stick"),
        scale(0.2),
        pos(100, 100),
        outline(2),
        area(),
        "draggable"
    ]);

    let isDragging = false;
    let dragOffset = vec2(0, 0);

    draggable.onClick(() => {
        isDragging = true;
        dragOffset = mousePos().sub(draggable.pos);
    });

    onMouseRelease(() => {
        if (isDragging) {
            isDragging = false;

            if (draggable.isColliding(target)) {
                add([
                    text("Sucesso!", { size: 32 }),
                    pos(200, 50),
                ]);
            }
        }
    });
    1
    onUpdate(() => {
        if (isDragging) {
            draggable.pos = mousePos().sub(dragOffset);
        }
    });
}
