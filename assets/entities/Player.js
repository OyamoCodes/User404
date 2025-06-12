import { NPC_DIALOGS } from './Npc.js';
export class Player {
    hasJumpedOnce = false
    constructor(posX, posY, speed, jumpForce, guideProgress, inputBox) {
        this.guideProgress = guideProgress;
        this.inputBox = inputBox;
        this.speed = speed;
        this.jumpForce = jumpForce;

        this.makePlayer(posX, posY);
        this.previousHeight = this.gameObj.pos.y;
        this.setPlayerControls();
    }
    makePlayer(posX, posY) {
        this.gameObj = add([
            sprite("player", { anim: "idle" }),
            scale(0.7),
            area({ width: 200, height: 200 }),
            anchor("center"),
            pos(posX, posY),
            body(),
            "player",
        ])
    }
    setPlayerControls() {
        onKeyDown("a", () => {
            if (this.gameObj.paused || this.inputBox !== 0) return
            if (this.gameObj.curAnim() !== "run") this.gameObj.play("run")
            this.gameObj.flipX = true
            this.gameObj.move(-this.speed, 0);
            //console.log(this.inputBox);
        })
        onKeyDown("d", () => {
            if (this.gameObj.paused || this.inputBox !== 0) return
            if (this.gameObj.curAnim() !== "run") this.gameObj.play("run")
            this.gameObj.flipX = false
            this.gameObj.move(this.speed, 0);
        })
        onKeyPress("w", () => {
            if (this.gameObj.paused || this.inputBox !== 0) return;
            if (this.gameObj.isGrounded() && !this.hasJumpedOnce) {
                this.gameObj.play("jump")
                this.gameObj.jump(this.jumpForce);
                this.hasJumpedOnce = true;
            }
        });

        onClick("npc", (npc) => {
            const npcId = npc.npcId;
            if (npcId) {
                const dialogues = NPC_DIALOGS[npcId];
                if (dialogues) {
                    console.log("Clicked NPC:", npcId);
                    add([
                        text(dialogues[0], { size: 18 }),
                        pos(300, 300),
                        anchor("center"),
                        color(255, 255, 255),
                        fixed(),
                        lifespan(3),
                    ]);
                    this.inputBox = 1;
                }
            }
        });

        onKeyRelease(() => {
            if (isKeyReleased("a") || isKeyReleased("d") || isKeyReleased("w")) {
                this.gameObj.play("idle")
            }
        })

        onUpdate(() => {
            if (this.hasJumpedOnce && this.gameObj.isGrounded()) {
                this.hasJumpedOnce = false;
            }
        });
    }

    updateGuideProgress() {
        onUpdate(() => {
            guideProgressUI.text = `$(this.guideProgress)`;
            /*if (this.guideProgress === 0) {
                uiGuide.displayGuidedUI(this.guideProgress);
            } else if (this.guideProgress === 1) {
                uiGuide.displayGuidedUI(this.guideProgress);
            } else if (this.guideProgress === 2) {
                uiGuide.displayGuidedUI(this.guideProgress);
            } else if (this.guideProgress === 3) {
            }*/
        });
    }

    updateScene() {
        onUpdate(() => {
            if (this.specialScene && typeof this.specialScene === "string") {
                go(this.specialScene);
            }
        });
    }

}