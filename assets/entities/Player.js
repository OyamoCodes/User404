export class Player {
    hasJumpedOnce = false
    constructor(posX, posY, speed, jumpForce, currentLevel, isInTerminalScene) {
        this.isInTerminalScene = isInTerminalScene;
        this.currentLevel = currentLevel;
        this.speed = speed;
        this.jumpForce = jumpForce;

        this.makePlayer(posX, posY);
        this.previousHeight = this.gameObj.pos.y;
        this.setPlayerControls();
    }
    makePlayer(posX, posY) {
        this.gameObj = add([
            sprite("player", { anim: "idle" }),
            area(),
            anchor("center"),
            pos(posX, posY),
            scale(0.7),
            body(),
            "player",
        ])
    }

    setPlayerControls() {
        onKeyDown("a", () => {
            if (this.gameObj.paused) return
            if (this.gameObj.curAnim() !== "run") this.gameObj.play("run")
            this.gameObj.flipX = true
            this.gameObj.move(-this.speed, 0);
        })
        onKeyDown("d", () => {
            if (this.gameObj.paused) return
            if (this.gameObj.curAnim() !== "run") this.gameObj.play("run")
            this.gameObj.flipX = false
            this.gameObj.move(this.speed, 0);
        })
        onKeyPress("w", () => {
            if (this.gameObj.paused) return;
            if (this.gameObj.isGrounded() && !this.hasJumpedOnce) {
                this.gameObj.play("jump")
                this.gameObj.jump(this.jumpForce);
                this.hasJumpedOnce = true;
            }
        });

        onKeyPress("e", () => {
            const touching = get("interactable").find(obj => player.gameObj.isTouching(obj));
            if (touching) {
                debug.log("Estás na zona de interação!");
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
}