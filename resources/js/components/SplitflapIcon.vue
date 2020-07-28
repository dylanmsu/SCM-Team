<template>
    <div style="display: inline" :style="this.icons[this.mydata].color">
        {{this.icons[this.mydata].icon}}
    </div>
</template>

<script>
export default {
    props: ['icon_index'],
    data() {
        return {
            mydata: this.icon_index,
            icons: [
                { icon: '[blank]', color: '', index: 0 },
                { icon: 'IC', color: '', index: 1 },
                { icon: 'IR', color: '', index: 2 },
                { icon: 'L', color: '', index: 3 },
                { icon: 'P', color: '', index: 4 },
                { icon: 'EXP', color: '', index: 5 },
                { icon: 'IR', color: 'color: red', index: 6 },
                { icon: 'IT', color: 'color: red', index: 7 },
                { icon: '?', color: 'color: red', index: 8 },
                { icon: 'INT', color: 'color: red', index: 9 },
                { icon: 'T', color: '', index: 10 },
                { icon: 'STOOM', color: '', index: 11 },
                { icon: 'MV', color: '', index: 12 },
                { icon: 'KRUIS', color: '', index: 13 },
                { icon: 'ORIENT', color: '', index: 14 },
                { icon: 'DIENST', color: 'color: red', index: 15 },
            ],
        }
    }
}
</script>