<template>
      <PanelMenu :model="items" />
</template>

<script>
export default {
   data() {
      return {
         items: [
            {
               label:'STUDENT LIFE',
               icon:'fas fa-user-graduate',
               items:[
                  {
                     label:'Clubs',
                     icon:'pi pi-fw pi-users',
                     items:[
                        {
                           label:'Events',
                           icon:'pi pi-fw pi-calendar',
                           items:[
                              {
                                 label:'Robotic',
                                 icon:'fas fa-robot',
                                 items:[
                                    {
                                       label:'VEX Robotics Competition ',
                                       icon:'pi pi-fw pi-calendar-plus'
                                    },
                                    {
                                       label:'World Robot Olympiad',
                                       icon:'pi pi-fw pi-calendar-plus'
                                    },
                                 ]
                              },
                              {
                                 label:'Movies',
                                 icon:'fas fa-video',
                                 items:[
                                    {
                                       label:'The Power of the Dog ',
                                       icon:'fas fa-compact-disc'
                                    },
                                    {
                                       label:'	House of Gucci',
                                       icon:'fas fa-compact-disc'
                                    }
                                 ]
                              }
                           ]
                        },
                     ]
                  },
                  {
                     label:'Expression',
                     icon:'pi pi-fw pi-discord'
                  }
               ]
            },
            {
               label: 'Private spaces',
               icon: 'fas fa-user-shield',
               items:[
                  {
                     label:'Teachers area',
                     icon:'pi pi-fw pi-angle-double-right'
                  },
                  {
                     label: 'Student area',
                     icon:'pi pi-fw pi-angle-double-right'
                  },
                  {
                     label:'Online services',
                     icon:'pi pi-fw pi-angle-double-right'
                  },
                  {
                     label: 'Educational documents',
                     icon:'pi pi-fw pi-angle-double-right'
                  },
                  {
                     label: 'FAQ',
                     icon:'pi pi-fw pi-angle-double-right'
                  }
               ]
            }
         ]
      }
   },
    methods: {
        toggle(event) {
            this.$refs.menu.toggle(event);
        }
    }
}
</script>

<style lang="scss">
   .p-panelmenu{
      width: 300px;
      .p-panelmenu-panel{
         .p-panelmenu-header{
            .p-panelmenu-header-link{
               color: #fff;
               background: #073772;
               .p-menuitem-icon{
                  margin-left: 5rem;
               }
               &:hover{
                  color: #fff !important;
                  background: #f36f21 !important;
               }
            }
         }
         .p-highlight{
            .p-panelmenu-header-link{
               background: #f36f21;
            }
         }
      }
   }

   @media (max-width: 1110px) {
      .p-panelmenu{
         width: 400px !important;
         display: flex;
         align-items: flex-start;
         justify-content: flex-start; 


         .p-menuitem-icon{
            margin-left: 1rem !important;
         }
      }
   }

   @media (max-width: 550px) {
      .p-panelmenu{
         transform: translateX(-9vw);
         justify-content: center !important;

         .p-panelmenu-header{
            font-size: 10px !important;
         }
      }
   }
</style>