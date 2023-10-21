<div x-data="{ value: 2 }" id="{{$name}}-input" class="grid grid-cols-3 place-items-stretch gap-2">

    <button @click="value=1" type="button" :class="(value===1 ? 'ring-4 ring-blue-300 ' : '') + 'text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'">
        <label class="cursor-pointer" for="{{$name}}-1">
            {{$low}}
        </label>
    </button>
    <input class="hidden" type="radio" id="{{$name}}-1" name="{{$name}}" value="1" :checked="value===1" />

    <button @click="value=2" type="button" :class="(value===2 ? 'ring-4 ring-blue-300 ' : '') + 'text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'">
        <label class="cursor-pointer" for="{{$name}}-2">
            {{$medium}}
        </label>
    </button>
    <input class="hidden" type="radio" id="{{$name}}-2" name="{{$name}}" value="2" :checked="value===2" />

    <button @click="value=3" type="button" :class="(value===3 ? 'ring-4 ring-blue-300 ' : '') + 'text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'">
        <label class="cursor-pointer" for="{{$name}}-3">
            {{$high}}
        </label>
    </button>
    <input class="hidden" type="radio" id="{{$name}}-3" name="{{$name}}" value="3" :checked="value===3" />

</div>