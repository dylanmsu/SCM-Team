<template>
    <div>
        <div :style="this.icons[this.mydata].color">
            {{this.icons[this.mydata].icon}}
        </div>
    </div>
</template>

<script>
export default {
    props: ['icon_index'],
    data() {
        return {
            mydata: this.icon_index,
            icons: [
                { icon: ' ', color: 'color: black', index: 0 },
                { icon: 'ic', color: 'color: black', index: 1 },
                { icon: 'IR', color: 'color: black', index: 2 },
                { icon: 'L', color: 'color: black', index: 3 },
                { icon: 'P', color: 'color: black', index: 4 },
                { icon: 'EXP', color: 'color: black', index: 5 },
                { icon: 'IR', color: 'color: red', index: 6 },
                { icon: 'IT', color: 'color: red', index: 7 },
                { icon: '?', color: 'color: red', index: 8 },
                { icon: 'INT', color: 'color: red', index: 9 },
                { icon: 'T', color: 'color: black', index: 10 },
                { icon: 'STOOM', color: 'color: black', index: 11 },
                { icon: 'MV', color: 'color: black', index: 12 },
                { icon: 'KRUIS', color: 'color: black', index: 13 },
                { icon: 'ORIENT', color: 'color: black', index: 14 },
                { icon: 'DIENST', color: 'color: red', index: 15 },
            ],
        }
    }
}
</script>