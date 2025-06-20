class UIManager {
    displayHotbar(element) {
        add([
            sprite("hotbar"),
            fixed(),
            z(150),
        ])
        if (element) {
            add([
                sprite(element),
                fixed(),
                z(100),
            ])

        }
    }
    displayBlinkingUIMessage(content, position) {
        const message = add([
            text(content, {
                size: 24,
                font: "Tahoma",
            }),
            area(),
            anchor("center"),
            pos(position),
            opacity(),
            state("flash-up", ["flash-up", "flash-down"]),
        ])
        message.onStateEnter("flash-up", async () => {
            await tween(
                message.opacity,
                0,
                0.5,
                (nextOpacityValue) => message.opacity = nextOpacityValue,
                easings.linear
            )
            message.enterState("flash-down");
        })
        message.onStateEnter("flash-down", async () => {
            await tween(
                message.opacity,
                1,
                0.5,
                (nextOpacityValue) => message.opacity = nextOpacityValue,
                easings.linear
            )
            message.enterState("flash-up");
        })
    }

    displayMainMenu() {
        add([
            sprite("bg_menu"),
        ])
        add([
            sprite("icon"),
            area(),
            anchor("center"),
            pos(center().x, center().y - 100),
            scale(0.60)
        ])
        add([
            text("Prototype", {
                size: 48,
                font: "Tahoma",
            }),
            pos(0, 660),
            scale(0.7),
        ])

        //Botão
        const startButton = add([
            rect(300, 75),
            pos(300, 300),
            color(0, 0, 255),
            area(),
            anchor("center"),
            z(100),
            "start_button",
        ])

        add([
            text("Começar", { size: 32, font: "Tahoma" }),
            pos(startButton.pos),
            anchor("center"),
            z(101),
        ])

        startButton.onHover(() => {
            startButton.color = rgb(0, 90, 200)
        })
        startButton.onHoverEnd(() => {
            startButton.color = rgb(0, 70, 170)
        })

        startButton.onClick(() => {
            go("1")
        })

        // Botão
        const controlsButton = add([
            rect(300, 75),
            pos(300, 400),
            color(0, 0, 255),
            area(),
            anchor("center"),
            z(100),
            "controls_button",
        ])

        add([
            text("Drag Test", { size: 32, font: "Tahoma" }),
            pos(controlsButton.pos),
            anchor("center"),
            z(101),
        ])

        controlsButton.onHover(() => {
            controlsButton.color = rgb(0, 90, 200)
        })
        controlsButton.onHoverEnd(() => {
            controlsButton.color = rgb(0, 70, 170)
        })

        controlsButton.onClick(() => {
            go("dragTest")
        })
        this.displayBlinkingUIMessage("Clica [ENTER] para começar", vec2(center().x, center().y + 100));

        onKeyPress("enter", () => {
            go("controls");
        });
        
    }

    displayControls() {
        add([
            sprite("bg_menu"),
        ])
        add([
            text("Controles", {
                size: 48,
                font: "Tahoma",
            }),
            area(),
            anchor("center"),
            pos(center().x, center().y - 100),
        ])
        const controlsText = add([
            pos(center().x + 30, center().y),
        ])
        //1h
        controlsText.add([
            text("\nW - Pular\n\nA - Mover para a esquerda\n\nD - Mover para a direita\n\nE - Interagir", {
                size: 24,
                font: "Tahoma",
            }),
            area(),
            anchor("center"),
        ]);
        this.displayBlinkingUIMessage("Clica [ENTER] para continuar", vec2(center().x, center().y + 150));
        onKeyPress("enter", () => {
            play("start_windows", { speed: 1.3, volume: 0 });
            go("1");
        });
    }

    displayControls() {
        add([
            sprite("bg_menu"),
        ])
        add([
            text("Sobre", {
                size: 48,
                font: "Tahoma",
            }),
            area(),
            anchor("center"),
            pos(center().x, center().y - 100),
        ])
        const controlsText = add([
            pos(center().x + 30, center().y),
        ])
        //1h
        controlsText.add([
            text("\nW - Pular\n\nA - Mover para a esquerda\n\nD - Mover para a direita\n\nE - Interagir", {
                size: 24,
                font: "Tahoma",
            }),
            area(),
            anchor("center"),
        ]);
        this.displayBlinkingUIMessage("Clica [ENTER] para continuar", vec2(center().x, center().y + 150));
        onKeyPress("enter", () => {
            play("start_windows", { speed: 1.3, volume: 0 });
            go("1");
        });
    }
}

export const uiManager = new UIManager();