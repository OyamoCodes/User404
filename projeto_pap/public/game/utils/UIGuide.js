import { checkInputBox } from "./InputCheckers.js";
import { guideLines } from "./Guide.js";
import { text } from "kaboom";

class UIGuide {
    constructor() {
        this.guideText = null;
        this.guideSprite = null;
    }

    displayGuidedUI(guideProgress) {
        if (this.guideText) destroy(this.guideText);
        if (this.guideSprite) destroy(this.guideSprite);

        this.guideText = add([
            text(guideLines.test[guideProgress] || "", {
                size: 24,
                font: "Tahoma",
                align: "center",
            }),
            color(BLACK),
            pos(850, 50),
            fixed(),
            z(300),
        ]);
    }

    updateGuideText(guideProgress) {
        if (this.guideText) {
            this.guideText.text = guideLines.test[guideProgress] || "";
        }
    }
    showDialogue(speaker, dialogueTextContent) {
        // Evita usar o nome "text" como variável
        const speakerText = add([
            text(speaker + ":", { size: 24 }), // usa a função global
            pos(20, height() - 140),
            color(255, 255, 255),
            fixed(),
            z(110),
        ]);

        const dialogueText = add([
            text(dialogueTextContent, { size: 20, width: width() - 40 }),
            pos(20, height() - 110),
            color(255, 255, 255),
            fixed(),
            z(110),
        ]);
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


