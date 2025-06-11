class UIGuide {
    displayGuidedUI(guideProgress) {
        switch (guideProgress) {
            case 0:
                add([
                    sprite("notepad"),
                    fixed(),
                    z(150),
                    pos(845, -165),
                ])
                add([
                    text("Press 'E' to interact with objects", {
                        size: 24,
                        font: "Tahoma",
                    }),
                    color(BLACK),
                    area(),
                    pos(855, 65),
                    fixed(),
                    z(300),
                ])

                break;

            default:
                break;
        }

    }
}
export function showInputBox(callback) {
    let inputText = "";

    add([
        sprite("notepad"),
        pos(100, 100),
        scale(1),
        z(1),
        "notepad_ui", // 🔖 tag para depois remover
    ]);

    const inputTextDisplay = add([
        text("", { size: 24 }),
        pos(120, 110),
        z(2),
        "notepad_ui", // 🔖 tag também
        {
            update() {
                this.text = inputText;
            }
        }
    ]);

    onCharInput((ch) => {
        if (inputText.length < 20) {
            inputText += ch;
        }
    });

    onKeyPress("backspace", () => {
        inputText = inputText.slice(0, -1);
    });

    onKeyPress("enter", () => {
        if (callback) callback(inputText);
    });
}

export const uiGuide = new UIGuide();