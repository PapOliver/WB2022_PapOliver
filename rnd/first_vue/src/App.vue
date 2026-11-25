<script>
  export default {
    data() {
      return {
        foods: [
            { name: "Omlós",
              desc: "Fokhagymásan",
                isFavorite: true,
                url:'img_apple.svg'
             },
            { name: "Cigány",
             desc: "Sült", 
             isFavorite: false,
             url:'img_cake.svg'
            },
            { name: 
              "Pecsenye", 
              desc: "Omlós", 
              isFavorite: false,
              url:'img_fish.svg'
            },
            { name: "Sült", 
            desc: "nem nyers", 
            isFavorite: true,
            url:'img_pizza.svg'
          },
            { name: "Kreki", 
            desc: "Sült", 
            isFavorite: false,
            url:'img_rice.svg'
          },
            { name: "Fokhagymásan",
             desc:" Fokhagymásan ",
             isFavorite: true,
             url:'img_pizza.svg'
            },
            { name: "Bolozsnyai", 
             desc: "Vagy hogy mondjátok", 
             isFavorite: true,
             url:'img_apple.svg'
          },
          {
            name: "Robi",
            desc: "Félig nyers",
            isFavorite: false,
            url:'img_rice.svg'
          }
          ],
          newItem: "",
          thirdItem: "",
          items: ["Ez", "Az", "Amaz"],
          ToggleValue: true,
          compName: "comp-one",
          activeComp: "food-about",
          inpVal: "",
          inpValSubmitted: " Még nincs belküldve",
          likedFoods: [],
          carselected: [],
          fileInp: "",
          selectedFileName: "",
          heightInp: "50",
          colorInp: "#ff0000",
          txtInp: "",
        }
      },
      methods: {
        registerAnswer() {
          if (this.inpVal) 
          {
            this.inpValSubmitted = this.inpVal;
          } 
          else 
          {
            this.inpValSubmitted = "Nincs kiválasztva";
          }
          
        },
        registerAnswer2() {
          this.inpValSubmitted = this.inpVal;
          
        },
        registerAnswer3() {
          this.inpValSubmitted = this.carselected;
          
        },
        registerAnswer4() {
          if (this.fileInp) 
          {
            this.inpValSubmitted = this.fileInp;
          } 
          else 
          {
            this.inpValSubmitted = "Nincs kiválasztva";
          }
          
        },
        updateValue(event) {
          this.fileInp = event.target.value;
          if (this.fileInp) {
            this.selectedFileName = this.fileInp.name;
          } else {
            this.selectedFileName = "";
          }
        },
        removeitem(){
          this.foods.splice(0, 1);
        },
        reciveEmit(foodId){
          const foundfood = this.foods.find(food => food.name === foodId);
          if (foundfood) {
            foundfood.isFavorite = !foundfood.isFavorite;
          }
        },
        addItem(){
          if (this.newItem.trim().length > 0 && !this.items.includes(this.newItem.trim())) {
            this.items.push(this.newItem.trim());
            this.newItem = "";
          }
        },
        changeValue() {
          this.$refs.p1.innerHTML = "Szia";
        },
        
        transferText() {
          this.$refs.p2.innerHTML = this.$refs.p1.innerHTML;
        },
        getRefs() {
          this.$refs.p1.innerHTML = this.$refs.input1.value;
        },
         getThirdItem() {
          this.thirdItem = this.$refs.li1[2].innerHTML;
        },
        updateVal(event) {
          const file = event.target.files[0];
          if (file) {
            this.selectedFileName = file.name;
          } else {
            this.selectedFileName = "";}  
          }
      }
      ,
      computed: {   
      }
      ,
      methods: {
       

      }, 

      
      provide() {
        return {
          foods: this.foods
        }
      }
      
    }
      
    
</script>

<template>
  
  <p ref="p1" style="color: green;">Kattints a gombra hogy ez a szöveg az alábbi bekezdésbe kerüljön</p> 
  <p>Kattints a gombra, hogy a zöld p elem szövege "Szia" legyen.</p>
  <button @click="transferText">Szöveg módosítása</button> 
  <p>Kezdj el gépelni a mezőben, a szövg alul is megjelenik</p>
  <input ref="input1" @input="getRefs" placeholder="Ide írj valamit">
  <p ref="p1" style="color: green;">Ez az eredeti szöveg</p>
<p>Kattints a gombra, a  lista 3. elemének megjelenítéséhez.</p>
  <button @click="getThirdItem">3. ista elem lekérése</button>

  <ul>
    <li v-for="x in foods" 
      :key="x.name"
      ref="li1"
      >{{x.name}}
    </li>
  </ul>
  <p>{{ thirdItem }}</p>


      



    <h1>Ételek?</h1>

    <div id="wrapper">

      <food-item v-for="x in foods" 
      :key="x.name"
      :foodName="x.name" 
      :foodDesc="x.desc" 
      :isFavorite="x.isFavorite"
      @toggle-favorite="reciveEmit"
      />
      
    </div>
    
    <button @click ="removeitem">Törlés</button>
  
    <h3>Teendők listája</h3>
    <ul>
      <todo-item v-for="x in items"
      :key="x"
      :item-name="x"
      style="background-color: purple"
      />  
    </ul>
    <input v-model="newItem">
    <button @click="addItem">Hozzáadás</button>

    
    <comp-one></comp-one>

    <comp-two></comp-two>
    
    <div id="wrapper"> 
      <slot-comp v-for="x in foods":key="x.name">
        <img :src="x.url">
        <h4>{{x.name}}</h4>
        <p>{{x.desc}}</p>
      </slot-comp>
    </div>

  <slot-comp  #leftSlot="leftProps">
    <div>{{leftProps.text}}</div>
  </slot-comp>

  <slot-comp  #rightSlot="rightProps">
    <div>{{rightProps.text}}</div>
  </slot-comp>

  
  <h1>Dinamikus komponens</h1>
  <label> <input type="radio" name="dynamicComp" v-model="compName" value="comp-one">One</label>
  <label> <input type="radio" name="dynamicComp" v-model="compName" value="comp-two">Two</label>
  <label> <input type="radio" name="dynamicComp" v-model="compName" value="comp-three">Three</label>

  <KeepAlive :max="4">
    <component :is="compName"></component>
  </KeepAlive>
  
  <h1>Ételek</h1>
  <div @click="activeComp='food-about'">Bemutatlkozás</div> 
  <div @click="activeComp='food-kinds'">Ételek?(nem)</div>
  <div>
    <component :is="activeComp"></component>
  </div>
  

  <h1>Rádiogombok</h1>
  <form @submit.prevent="registerAnswer">
    <p>Kedvenc Állatod:</p>
      <label>
        <input type="radio" name="favAnimal" v-model="inpVal" value="Macska">
        Macska
      </label>

    <label>
      <input type="radio" name="favAnimal" v-model="inpVal" value="Kutya">
      Kutya
    </label>

    <label>
      <input type="radio" name="favAnimal" v-model="inpVal" value="Brendon">
      Brendon
    </label>

    <button type="submit">Küldés</button>
  </form>
  <p>Beküldött válasz: {{ inpValSubmitted }}</p>


  <h1>Jelölőnégyzetek</h1>
  <form @submit.prevent="registerAnswer2">
    <p>Milyen ételek tetszenek a legjobban?</p>
      <label>
        <input type="checkbox" v-model="likedFoods" value="Macska">
        Macska
      </label>

    <label>
      <input type="checkbox" v-model="likedFoods" value="Robi">
      Robi
    </label>

    <label>
      <input type="checkbox" v-model="likedFoods" value="Kreki">
      Kreki
    </label>
  </form>
  <p>Beküldött válasz: {{ likedFoods }}</p>



  <h1>Legördülő lista</h1>
    <form @submit.prevent="registerAnswer3">
      <label for="cars">Válassz egy autót:</label>
      <select id="cars" v-model="carselected" multiple>
        <option disabled value="">--Válassz egyet--</option>
        <option value="320d">BMW e46 320d</option>
        <option value="Agera">Koenigsegg Agera RS</option>
        <option value="R35">Nissan Skyline GTR R-35</option>
      </select>  
    
    </form>
    <p>Beküldött válasz: {{ carselected }}</p>


    <h1>File kiválasztása</h1>
    <form @submit.prevent="registerAnswer3">
      <label for="fileInput">Válassz egy fájlt:
        <input type="file" id="fileInput" @change="updateValue">
      </label>
      <p>Beküldött fájl: {{ selectedFileName }}</p>
    </form>


    <h1>Height és Color</h1>
    <form @submit.prevent="registerAnswer5">
      <label>
        <input type="file" @change="updateVal">
      </label>
      
      <label>Milyen magas vagy? <br>
        <input type="range" v-model="heightInp" min="50" max="250">
      </label>
      <label >
        Válassz egy színt: <br>
        <input type="color" v-model="colorInp">
      </label>
      <textarea v-model="txtInp" placeholder="Írj ide egy szöveget..." rows="4" cols="35"></textarea>
    
      <p :style="{ backgroundColor: colorInp }">Beküldött válasz: {{ heightInp }} cm, {{ txtInp }}</p>






    </form>

</template>

<style >
#wrapper > div {
  border: dashed rgb(76, 3, 136) 1px;
  flex-basis: 120px;
  margin: 10px;
  padding: 10px;
  background-color: rgb(103, 0, 134);
}

#wrapper >div:hover{
  cursor: pointer;
}

body
{
  background-color: wheat;
  color:black
}
#wrapper{
  display: flex;
  justify-content: wrap;
}
</style>