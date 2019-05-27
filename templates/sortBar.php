<div class="sortSection">
    <div class="sortHead">
        <div class="tab" onClick="changeTab('radio')">Sort By</div>
        <div class="tab" onClick="changeTab('checkBox')">Series Filter</div>
        <div class="tab" onClick="changeTab('yearSlider')">Year Filter</div>
    </div>
    <div id="sortBody">
        <div id="radioSection">
            <div class="radio ractive" onClick="setRadio('id')" id="rid">ID</div>
            <div class="radio" onClick="setRadio('name')" id="rname">Name</div>
            <div class="radio" onClick="setRadio('game')" id="rgame">Game</div>
            <div class="radio" onClick="setRadio('series')" id="rseries">Series</div>
            <div class="radio" onClick="setRadio('release')" id="ryear">Release Year</div>
        </div>
        <div id="checkSection">
            <div class="check active" onClick="toggleCheck('AnimalCrossing')" id="AnimalCrossing">Animal Crossing</div>
            <div class="check active" onClick="toggleCheck('Bayonetta')" id="Bayonetta">Bayonetta</div>
            <div class="check active" onClick="toggleCheck('Castlevania')" id="Castlevania">Castlevania</div>
            <div class="check active" onClick="toggleCheck('DK')" id="DK">Donkey Kong</div>
            <div class="check active" onClick="toggleCheck('DuckHunt')" id="DuckHunt">Duck Hunt</div>
            <div class="check active" onClick="toggleCheck('FinalFantasy')" id="FinalFantasy">Final Fantasy</div>
            <div class="check active" onClick="toggleCheck('FireEmblem')" id="FireEmblem">Fire Emblem</div>
            <div class="check active" onClick="toggleCheck('FZero')" id="FZero">FZero</div>
            <div class="check active" onClick="toggleCheck('GameWatch')" id="GameWatch">Game & Watch</div>
            <div class="check active" onClick="toggleCheck('IceClimber')" id="IceClimber">Ice Climber</div>
            <div class="check active" onClick="toggleCheck('KidIcarus')" id="KidIcarus">Kid Icarus</div>
            <div class="check active" onClick="toggleCheck('Kirby')" id="Kirby">Kirby</div>
            <div class="check active" onClick="toggleCheck('Mario')" id="Mario">Mario</div>
            <div class="check active" onClick="toggleCheck('MegaMan')" id="MegaMan">Mega Man</div>
            <div class="check active" onClick="toggleCheck('MetalGear')" id="MetalGear">Metal Gear</div>
            <div class="check active" onClick="toggleCheck('Metroid')" id="Metroid">Metroid</div>
            <div class="check active" onClick="toggleCheck('Mii')" id="Mii">Mii</div>
            <div class="check active" onClick="togglecheck('Mother')" id="Mother">Mother</div>
            <div class="check active" onClick="toggleCheck('Other')" id="Other">Other</div>
            <div class="check active" onClick="toggleCheck('PacMan')" id="PacMan">Pac-Man</div>
            <div class="check active" onClick="toggleCheck('Persona')" id="Persona">Persona</div>
            <div class="check active" onClick="toggleCheck('Pikmin')" id="Pikmin">Pikmin</div>
            <div class="check active" onClick="toggleCheck('Pokemon')" id="Pokemon">Pokemon</div>
            <div class="check active" onClick="toggleCheck('PunchOut')" id="PunchOut">Punch-Out!!</div>
            <div class="check active" onClick="toggleCheck('ROB')" id="ROB">R.O.B.</div>
            <div class="check active" onClick="toggleCheck('Smash')" id="Smash">Super Smash Brothers</div>
            <div class="check active" onClick="toggleCheck('Sonic')" id="Sonic">Sonic</div>
            <div class="check active" onClick="toggleCheck('Splatoon')" id="Splatoon">Splatoon</div>
            <div class="check active" onClick="toggleCheck('StarFox')" id="StarFox">Star Fox</div>
            <div class="check active" onClick="toggleCheck('StreetFighter')" id="StreetFighter">Street Fighter</div>
            <div class="check active" onClick="toggleCheck('Wario')" id="Wario">Wario</div>
            <div class="check active" onClick="toggleCheck('WiiFit')" id="WiiFit">Wii Fit</div>
            <div class="check active" onClick="toggleCheck('Xenoblade')" id="Xenoblade">Xenoblade</div>
            <div class="check active" onClick="toggleCheck('Yoshi')" id="Yoshi">Yoshi</div>
            <div class="check active" onClick="toggleCheck('Zelda')" id="Zelda">Zelda</div>
        </div>
        <div id="yearSlider">

        </div>
    </div>
</div>

<script>
    let activeTab = "radio";
    let radioSection = document.getElementById('radioSection');
    let checkSection = document.getElementById('checkSection');
    function toggleRadio(element) {
        let radios = radioSection.children();
    }
    function toggleCheck(element) {
        let checks = checkSection.children();
    }
</script>