export class Level{
    drawMapLayout(levelLayout, mappings){
        this.map = []
        for(const layerLayout of levelLayout){
            this.map.push(addLevel(layerLayout, layerSettings));
        }
        for (const layer of this.map){
            layer.use()
        }
    }
    drawBackground(bg_name, scale) {
        add([
            sprite(bg_name),
            fixed(),
            scale(scale)
        ]);
    }
}