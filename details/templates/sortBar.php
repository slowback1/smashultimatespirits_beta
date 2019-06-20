<div class="searchSection">
        <input type="text" onkeyup="getAutoResult()" id="searchText" placeholder="Search..." />
        <div id="searchResults">

        </div>
    </div>
    <div class="sortSection">
            <div class="sortHead">
                <form id="sortSettings">
                    <div id="sortSetRadios">
                        <p>Sort Type:</p>
                        <input type="radio" name="sort" value="id" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" checked>ID 
                        <input type="radio" name="sort" value="name" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" >Name
                        <input type="radio" name="sort" value="game" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)">Game
                        <input type="radio" name="sort" value="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)">Series
                        <input type="radio" name="sort" value="release_year" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)"> Release Year
                    </div>
                    <div id="sortSetCheckboxes">
                        <p>Series Filter:</p>
                        <div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="AnimalCrossing"> Animal Crossing</div>
                        <div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Bayonetta"> Bayonetta
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Castlevania"> Castlevania
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="DK"> Donkey Kong
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="DuckHunt"> Duck Hunt
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="FinalFantasy"> Final Fantasy
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="FireEmblem"> Fire Emblem
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="FZero"> F-Zero
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="GameWatch"> Game & Watch
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="IceClimber"> Ice Climber
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="KidIcarus"> Kid Icarus
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Kirby"> Kirby
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Mario"> Mario
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="MegaMan"> Mega Man
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="MetalGear"> Metal Gear
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Metroid"> Metroid
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Mii"> Mii
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Mother"> Mother
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="PacMan"> Pac-Man
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Persona"> Persona
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Pikmin"> Pikmin
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Pokemon"> Pokemon
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="PunchOut"> Punch Out
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="ROB"> R.O.B.
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Smash"> Super Smash Brothers
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Sonic"> Sonic
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Splatoon"> Splatoon
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="StarFox"> Star Fox
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="StreetFighter"> Street Fighter
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Wario"> Wario
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="WiiFit"> Wii Fit
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Xenoblade"> Xenoblade
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Yoshi"> Yoshi
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Zelda"> Zelda 
                        </div><div><input type="checkbox" name="series" onchange="callSidebarResults(handleSidebarSpiritInput(), 500, false)" value="Other"> Other
                    </div>
                    </div>
                    <div id="yearSlider" style="margin-top: 50px;"> <p>Year Filter:</p></div>
                    
                </form>
            </div>
            <div id="searchBody" class="searchBody">
                
            </div>
        </div>
</div>