import { checkInputBox } from "./InputCheckers.js";
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
export function showInputBox(callback, player) {
    let inputText = "";

    add([
        sprite("notepad"),
        pos(5, -160),
        scale(1),
        fixed(),
        z(150),
        "notepad_ui",
    ]);

    const inputTextDisplay = add([
        text("", { size: 24 }),
        pos(15, 70),
        fixed(),
        color(0, 0, 0),
        z(300),
        "notepad_ui",
        {
            update() {
                this.text = inputText;
            }
        }
    ]);

    onCharInput((ch) => {
        if (inputText.length < 30) {
            inputText += ch;
        }
    });

    onKeyPressRepeat("backspace", () => {
        inputText = inputText.slice(0, -1);
    });

    onKeyPress("enter", () => {
        if (callback) callback(inputText);
        checkInputBox(inputText, player);
    });
}


export const uiGuide = new UIGuide();