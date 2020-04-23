import React, { useState } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import InputLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import FormHelperText from '@material-ui/core/FormHelperText';
import FormControl from '@material-ui/core/FormControl';
import Select from '@material-ui/core/Select';

const Form = (props) => {

    const [value, setValue] = useState('Controlled');
  
    const handleFormInput = (event) => {
      setValue(event.target.value);
    };

    return (
        <div>
            <div className="notificationBox-large">
                Reikia įrašyti tik žaidimo pavadinimą ir kainą, bet jei užpildysite ir kitus laukus, bus lengviau jį rasti
            </div>
            <div className="input-field col s12">
                    <input 
                        placeholder="Pavadinimas *" 
                        className="newHabit-input"
                        name="title"  
                        value={props.newItem.title}
                        onChange={(event) => props.handleFormInput(event.target.name, event.target.value)}   
                        />
                </div>
            <div className="input-field col s6">
                <FormControl>
                    <InputLabel id="demo-simple-select-label">Formatas</InputLabel>
                        <Select
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
                            name="format"
                            value={props.newItem.format}
                            onChange={(event) => props.handleFormInput(event.target.name, event.target.value)}
                        >
                            <MenuItem value={"atari"}>Atari 2600</MenuItem>
                            <MenuItem value={"nes"}>NES / Famicom / Klonai</MenuItem>
                            <MenuItem value={"snes"}>SNES / Super Famicom</MenuItem>
                            <MenuItem value={"nintendo64"}>Nintendo 64</MenuItem>
                            <MenuItem value={"sega_master_system"}>Sega Master System</MenuItem>
                            <MenuItem value={"sega_genesis"}>Sega Mega Drive / Genesis</MenuItem>
                            <MenuItem value={"nintendo_gc"}>Nintendo GameCube</MenuItem>
                            <MenuItem value={"nintendo_wii"}>Nintendo Wii</MenuItem>
                            <MenuItem value={"sega_cd"}>Sega CD</MenuItem>
                            <MenuItem value={"sega_saturn"}>Sega Saturn</MenuItem>
                            <MenuItem value={"sega_dreamcast"}>Sega DreamCast</MenuItem>
                            <MenuItem value={"ps1"}>Play Station</MenuItem>
                            <MenuItem value={"ps2"}>Play Station 2</MenuItem>
                            <MenuItem value={"ps3"}>Play Station 3</MenuItem>
                            <MenuItem value={"ps4"}>Play Station 4</MenuItem>
                            <MenuItem value={"xbox"}>XBox</MenuItem>
                            <MenuItem value={"xbox_360"}>XBox 360</MenuItem>
                            <MenuItem value={"xbox_one"}>Xbox One</MenuItem>
                            <MenuItem value={"nintendo_game_and_watch"}>Nintendo Game & Watch / Elektronika</MenuItem>
                            <MenuItem value={"nintendo_gb"}>Nintendo Game Boy</MenuItem>
                            <MenuItem value={"nintendo_gbc"}>Nintendo Game Boy Color</MenuItem>
                            <MenuItem value={"nintendo_gba"}>Nintendo Game Boy Advance</MenuItem>
                            <MenuItem value={"nintendo_ds"}>Nintendo DS</MenuItem>
                            <MenuItem value={"nintendo_3ds"}>Nintendo 3DS</MenuItem>
                            <MenuItem value={"nintendo_switch"}>Nintendo Switch</MenuItem>
                            <MenuItem value={"sega_game_gear"}>Sega Game Gear</MenuItem>
                            <MenuItem value={"psp"}>Play Station Portable</MenuItem>
                            <MenuItem value={"ps_vita"}>Play Station Vita</MenuItem>
                            <MenuItem value={"other"}>Kiti</MenuItem>
                        </Select>
                </FormControl>
            </div>
            <div className="input-field col s6">
                <FormControl>
                    <InputLabel id="demo-simple-select-label">Žanras</InputLabel>
                        <Select
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
                            name="genre"
                            value={props.newItem.genre}
                            onChange={(event) => props.handleFormInput(event.target.name, event.target.value)}
                        >
                            <MenuItem value={'action'}>Veiksmas</MenuItem>
                            <MenuItem value={'adventure'}>Nuotykiai</MenuItem>
                            <MenuItem value={'rpg'}>Rolės</MenuItem>
                            <MenuItem value={'sim'}>Simuliacija</MenuItem>
                            <MenuItem value={'strategy'}>Strategija</MenuItem>
                            <MenuItem value={'sport'}>Sportas</MenuItem>
                            <MenuItem value={'racing'}>Lenktynės</MenuItem>
                            <MenuItem value={'puzzle'}>Galvosūkis</MenuItem>
                        </Select>
                </FormControl>
            </div>
            <div className="input-field col s6">
                <FormControl>
                    <InputLabel id="demo-simple-select-label">Metai</InputLabel>
                        <Select
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
                            name="year"
                            value={props.newItem.year}
                            onChange={(event) => props.handleFormInput(event.target.name, event.target.value)}
                        >
                            <MenuItem value={1977}>1977</MenuItem>
                            <MenuItem value={1978}>1978</MenuItem>
                            <MenuItem value={1979}>1979</MenuItem>
                            <MenuItem value={1980}>1980</MenuItem>
                            <MenuItem value={1981}>1981</MenuItem>
                            <MenuItem value={1982}>1982</MenuItem>
                            <MenuItem value={1983}>1983</MenuItem>
                            <MenuItem value={1984}>1984</MenuItem>
                            <MenuItem value={1985}>1985</MenuItem>
                            <MenuItem value={1986}>1986</MenuItem>
                            <MenuItem value={1987}>1987</MenuItem>
                            <MenuItem value={1988}>1988</MenuItem>
                            <MenuItem value={1989}>1989</MenuItem>
                            <MenuItem value={1990}>1990</MenuItem>
                            <MenuItem value={1991}>1991</MenuItem>
                            <MenuItem value={1992}>1992</MenuItem>
                            <MenuItem value={1993}>1993</MenuItem>
                            <MenuItem value={1994}>1994</MenuItem>
                            <MenuItem value={1995}>1995</MenuItem>
                            <MenuItem value={1996}>1996</MenuItem>
                            <MenuItem value={1997}>1997</MenuItem>
                            <MenuItem value={1998}>1998</MenuItem>
                            <MenuItem value={1999}>1999</MenuItem>
                            <MenuItem value={2000}>2000</MenuItem>
                            <MenuItem value={2001}>2001</MenuItem>
                            <MenuItem value={2002}>2002</MenuItem>
                            <MenuItem value={2003}>2003</MenuItem>
                            <MenuItem value={2004}>2004</MenuItem>
                            <MenuItem value={2005}>2005</MenuItem>
                            <MenuItem value={2006}>2006</MenuItem>
                            <MenuItem value={2007}>2007</MenuItem>
                            <MenuItem value={2008}>2008</MenuItem>
                            <MenuItem value={2009}>2009</MenuItem>
                            <MenuItem value={2010}>2010</MenuItem>
                            <MenuItem value={2011}>2011</MenuItem>
                            <MenuItem value={2012}>2012</MenuItem>
                            <MenuItem value={2013}>2013</MenuItem>
                            <MenuItem value={2014}>2014</MenuItem>
                            <MenuItem value={2015}>2015</MenuItem>
                            <MenuItem value={2016}>2016</MenuItem>
                            <MenuItem value={2017}>2017</MenuItem>
                            <MenuItem value={2018}>2018</MenuItem>
                            <MenuItem value={2019}>2019</MenuItem>
                            <MenuItem value={2020}>2020</MenuItem>
                        </Select>
                </FormControl>
            </div>
            <div className="input-field col s6">
                <FormControl>
                    <InputLabel id="demo-simple-select-label">Būsena</InputLabel>
                        <Select
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
                            name="conditionRating"
                            value={props.newItem.conditionRating}
                            onChange={(event) => props.handleFormInput(event.target.name, event.target.value)}  
                        >
                            <MenuItem value={5}>★★★★★</MenuItem>
                            <MenuItem value={4}>★★★★</MenuItem>
                            <MenuItem value={3}>★★★</MenuItem>
                            <MenuItem value={2}>★★</MenuItem>
                            <MenuItem value={1}>★</MenuItem>
                        </Select>
                </FormControl>
            </div>
            <div className="input-field col s6">
                    <input 
                        placeholder="Leidėjas" 
                        className="newHabit-input"
                        name="publisher"  
                        value={props.newItem.publisher}
                        onChange={(event) => props.handleFormInput(event.target.name, event.target.value)}   
                        />
                </div>
            <div className="input-field col s6">
                <input 
                    placeholder="Kaina *" 
                    className="newHabit-input"
                    name="price"  
                    value={props.newItem.price}
                    onChange={(event) => props.handleFormInput(event.target.name, event.target.value)}   
                    />
            </div>
            <div className="input-field col s12">
                <input 
                    placeholder="Komentaras" 
                    className="newHabit-input"
                    name="comment"  
                    value={props.newItem.comment}
                    onChange={(event) => props.handleFormInput(event.target.name, event.target.value)}        
                    />
            </div>
        </div>
    );
}

//  value={format}
// onChange={handleChange}

export default Form;