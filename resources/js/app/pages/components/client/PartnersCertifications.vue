<template>
    <section class="partners-certifications-col">
        <div class="partners-col">
            <h1>Partners</h1>
            <Galleria :value="partners" :responsiveOptions="responsiveOptions" :numVisible="5" :showThumbnails="false" :showIndicators="true" :autoPlay="true" :circular="true">
                <template #item="slotProps">
                    <div class="partners">
                        <img :src="'/images/client/' + slotProps.item.name1" :alt="slotProps.item.alt1"/>
                        <img :src="'/images/client/' + slotProps.item.name2" :alt="slotProps.item.alt2"/>
                        <img :src="'/images/client/' + slotProps.item.name3" :alt="slotProps.item.alt3"/>
                        <img :src="'/images/client/' + slotProps.item.name4" :alt="slotProps.item.alt4"/>
                    </div>
                </template>
            </Galleria>
        </div>
        <div class="certification-col">
            <h1>Certification academies</h1>
            <Galleria :value="certifications" v-model:activeIndex="activeIndex" :responsiveOptions="responsiveOptions" :numVisible="7" containerStyle="max-width: 850px"
                :circular="true" :fullScreen="true" :showItemNavigators="true" :showThumbnails="false" v-model:visible="displayCustom">
                <template #item="slotProps">
                    <img :src="'/images/client/' + slotProps.item.name" :alt="slotProps.item.alt" style="display: block;"/>
                </template>
                <template #thumbnail="slotProps">
                    <img :src="'/images/client/' + slotProps.item.name" :alt="slotProps.item.alt" style="display: block;"/>
                </template>
            </Galleria>
            <div v-if="certifications" class="grid" style="max-width: 600px;">
                <div v-for="(certificate, index) of certifications" class="p-col-3" :key="index">
                    <img :src="'/images/client/' + certificate.name" :alt="certificate.alt" style="cursor: pointer; padding:20px;" @click="certificateClick(index)"/>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            activeIndex: 0,
            displayCustom: false,
            partners: [
                {name1: 'partner1.jpg', alt1: 'SAGEMCOM', name2: 'partner2.jpg', alt2: 'Freedom Of Dev', name3: 'partner3.jpg', alt3: 'FOCUS', name4: 'partner4.png', alt4: 'PERFECT SOFT'},
                {name1: 'partner5.jpg', alt1: 'Primatec', name2: 'partner6.jpg', alt2: 'LEONI', name3: 'partner7.jpg', alt3: 'Agro Etudes', name4: 'partner8.png', alt4: 'ACTIA'},
                {name1: 'partner9.png', alt1: 'GET Wireless', name2: 'partner10.png', alt2: 'Sofrecom', name3: 'partner11.jpg', alt3: 'TELNET', name4: 'partner12.jpg', alt4: 'Chifco'},
                {name1: 'partner13.jpg', alt1: 'SOFIA', name2: 'partner14.jpg', alt2: 'HUAWEI', name3: 'partner15.png', alt3: 'PROGED', name4: 'partner16.jpg', alt4: 'FOGITS'},
            ],
            certifications: [
                {name: 'certif1.png', alt: 'TOEIC'},
                {name: 'certif2.png', alt: 'IBM'},
                {name: 'certif3.jpg', alt: 'DELF'},
                {name: 'certif4.png', alt: 'HUAWEI HCNA'},
                {name: 'certif5.png', alt: 'CISCO'},
                {name: 'certif6.png', alt: 'TOEIC'},
            ],
			responsiveOptions: [
				{
                    breakpoint: '1024px',
                    numVisible: 5
                },
                {
                    breakpoint: '768px',
                    numVisible: 3
                },
                {
                    breakpoint: '560px',
                    numVisible: 1
                }
			]
        }
    },
    methods: {
        certificateClick(index) {
            this.activeIndex = index;
            this.displayCustom = true;
        }
    },
}
</script>

<style lang="scss">
.partners-certifications-col{
    text-align:center;
    padding-top: 50px;
    display: flex;
    justify-content: center !important;
    align-items: center;
    flex-wrap: wrap;

    h1{
        font-size: 25px !important;
        font-weight: 600;
        color: #436792;
        text-transform: uppercase;

        &::after {
            content: '';
            width: 30%;
            height: 1px;
            background: #073772;
            display: block;
            margin: auto;
        }
    }
    .partners{
        width: 300px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin: 20px auto;

        img{
            width: 120px;
            height: 80px;
            margin-bottom: 20px;
        }
    }
    .certification-col{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-top: 4rem;

        .grid{
            display: flex;
            align-items: center;
            justify-content: center;

            img{
                width: 140px;
                height: 80px;
            }
        }
    }
}

@media(max-width: 1110px){
    .partners-certifications-col{
        display: none;
    }
}

.p-galleria .p-galleria-indicators .p-galleria-indicator.p-highlight button {
    background: #f36f21 !important;
}
.p-galleria .p-galleria-indicators .p-galleria-indicator button {
    background-color: #fff !important;
    border: 3px solid #f36f21 !important; 
}
</style>