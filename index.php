<?php
if (!empty($_POST)) {
    $url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?language=fr";

    if (!empty($_POST["nom"]) && $_POST["search"] == "nom") $url .= "@fname=".$_POST["nom"];
    
    if ($_POST["selectType"] != "undefined") {
        if ($_POST["selectType"] == "Monstre") {
            if (!empty($_POST["selectSpec"]) && $_POST["selectSpec"] != "undefined") $url .= "@type=".$_POST["selectSpec"];
            if (!empty($_POST["attribut"])) $url .= "@attribute=".$_POST["attribut"];
            if (!empty($_POST["type"])) $url .= "@race=".$_POST["type"];
            if (!empty($_POST["atk"])) $url .= "@atk=".$_POST["atk"];
            if (!empty($_POST["def"])) $url .= "@def=".$_POST["def"];
    
            if (!empty($_POST["niv"]) && $_POST["selectSpec"] != "Link Monster") $url .= "@level=".$_POST["niv"];
            else if (!empty($_POST["niv"]) && $_POST["selectSpec"] == "Link Monster") $url .= "@linkval=".$_POST["niv"];
        } else if ($_POST["selectType"] == "Skill Card") {
            $url .= "@type=".$_POST["selectType"];
            if (!empty($_POST["pour"]) && $_POST["pour"] != "undefined") $url .= "@race=".$_POST["pour"];
        } else {
            $url .= "@type=".$_POST["selectType"];
            if (!empty($_POST["selectSpec"]) && $_POST["selectSpec"] != "undefined") $url .= "@race=".$_POST["selectSpec"];
        }
    }

    header("Location: http://localhost/YGOutil?apireq=" . $url . "");
    var_dump($url);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="style.css">
    <title>TestProj</title>
</head>
<body>
    <div>
        <div class="sticky-top" style="background-color:#989898">
            <form action="" method="POST">
                <div class="primaire ms-2">
                    <select class="mt-2" name="selectType" id="selectType">
                        <option selected value="undefined"></option>
                        <option value="Monstre">Monstre</option>
                        <option value="Spell Card">Magie</option>
                        <option value="Trap Card">Piège</option>
                        <option value="Skill Card">Compétence</option>
                    </select>
                
                    <select name="selectSpec" id="selectSpec" style="width:250px" disabled>
                        <option value="undefined" selected></option>
                        <option value="Normal Monster" id="norm" style="display:none">Normal</option>
                        <option value="Ritual Monster" id="ritnorm" style="display:none">Normal | Rituel</option>
                        <option value="Pendulum Normal Monster" id="pendnorm" style="display:none">Normal | Pendule</option>
                        <option value="Normal Tuner Monster" id="normtun" style="display:none">Normal | Synthoniseur</option>
                        <option value="Effect Monster" id="eff" style="display:none">Effet</option>
                        <option value="Flip Effect Monster" id="effflip" style="display:none">Effet | Flip</option>
                        <option value="Union Effect Monster" id="effuni" style="display:none">Effet | Union</option>
                        <option value="Ritual Effect Monster" id="effrit" style="display:none">Effet | Rituel</option>
                        <option value="Spirit Monster" id="effspi" style="display:none">Effet | Spirit</option>
                        <option value="Gemini Monster" id="effgem" style="display:none">Effet | Gémeau</option>
                        <option value="Pendulum Effect Monster" id="effpend" style="display:none">Effet | Pendule</option>
                        <option value="Tuner Monster" id="efftun" style="display:none">Effet | Synthoniseur</option>
                        <option value="Pendulum Flip Effect Monster" id="effflippend" style="display:none">Effet | Flip | Pendule</option>
                        <option value="Pendulum Effect Fusion Monster" id="efffuspend" style="display:none">Effet | Fusion | Pendule</option>
                        <option value="Flip Tuner Effect Monster" id="efffliptun" style="display:none">Effet | Synthoniseur | Flip</option>
                        <option value="Pendulum Tuner Effect Monster" id="efftunpend" style="display:none">Effet | Synthoniseur | Pendule</option>
                        <option value="Fusion Monster" id="fus" style="display:none">Fusion</option>
                        <option value="Synchro Monster" id="syn" style="display:none">Synchro</option>
                        <option value="Synchro Tuner Monster" id="syntun" style="display:none">Synchro | Synthoniseur</option>
                        <option value="Synchro Pendulum Effect Monster" id="synpend" style="display:none">Synchro | Pendule</option>
                        <option value="XYZ Monster" id="xyz" style="display:none">XYZ</option>
                        <option value="XYZ Pendulum Effect Monster" id="xyzpend" style="display:none">XYZ | Pendule</option>
                        <option value="Link Monster" id="lien" style="display:none">Lien</option>
                        <option value="Token" id="jet" style="display:none">Jeton</option>
                        <option value="normal" id="magNorm" style="display:none">Normale</option>
                        <option value="continuous" id="magCont" style="display:none">Continue</option>
                        <option value="quick-play" id="magRap" style="display:none">Rapide</option>
                        <option value="equip" id="magEqu" style="display:none">Équipement</option>
                        <option value="field" id="magTer" style="display:none">Terrain</option>
                        <option value="ritual" id="magRit" style="display:none">Rituelle</option>
                        <option value="normal" id="piegNorm" style="display:none">Normal</option>
                        <option value="continuous" id="piegCont" style="display:none">Continu</option>
                        <option value="counter" id="piegCount" style="display:none">Contre-Piège</option>
                    </select>

                    <div class="input-group" style="margin-left:900px">
                        <select name="search" style="width:80px">
                            <option selected value="nom">Nom</option>
                            <option value="code">Code</option>
                        </select>
                        <input type="text" name="nom" style="width:200px">
                        <button type="submit">Rechercher</button>
                    </div>

                    <script type="text/javascript">
                        document.getElementById("selectType").addEventListener("change", e => {
                            let etat = document.getElementById("selectType").value;
                
                            if (etat != "0" && etat != "Skill Card") {
                                document.getElementById("selectSpec").disabled = false;
                                document.getElementById("secondaire").style.display = "block";
                
                                if (etat == "Monstre") {
                                    document.getElementById("norm").style.display           = "block";
                                    document.getElementById("ritnorm").style.display        = "block";
                                    document.getElementById("pendnorm").style.display       = "block";
                                    document.getElementById("normtun").style.display        = "block";
                                    document.getElementById("eff").style.display            = "block";
                                    document.getElementById("effflip").style.display        = "block";
                                    document.getElementById("effuni").style.display         = "block";
                                    document.getElementById("effrit").style.display         = "block";
                                    document.getElementById("effspi").style.display         = "block";
                                    document.getElementById("effgem").style.display         = "block";
                                    document.getElementById("effpend").style.display        = "block";
                                    document.getElementById("efftun").style.display         = "block";
                                    document.getElementById("effflippend").style.display    = "block";
                                    document.getElementById("efffuspend").style.display     = "block";
                                    document.getElementById("efffliptun").style.display     = "block";
                                    document.getElementById("efftunpend").style.display     = "block";
                                    document.getElementById("fus").style.display            = "block";
                                    document.getElementById("syn").style.display            = "block";
                                    document.getElementById("syntun").style.display         = "block";
                                    document.getElementById("synpend").style.display        = "block";
                                    document.getElementById("xyz").style.display            = "block";
                                    document.getElementById("xyzpend").style.display        = "block";
                                    document.getElementById("lien").style.display           = "block";
                                    document.getElementById("jet").style.display            = "block";
                                    document.getElementById("magNorm").style.display        = "none";
                                    document.getElementById("magCont").style.display        = "none";
                                    document.getElementById("magRap").style.display         = "none";
                                    document.getElementById("magEqu").style.display         = "none";
                                    document.getElementById("magTer").style.display         = "none";
                                    document.getElementById("magRit").style.display         = "none";
                                    document.getElementById("piegNorm").style.display       = "none";
                                    document.getElementById("piegCont").style.display       = "none";
                                    document.getElementById("piegCount").style.display      = "none";

                                    document.getElementById("monstre").style.display = "block";
                                    document.getElementById("skill").style.display = "none";
                                } else if (etat == "Spell Card") {
                                    document.getElementById("norm").style.display           = "none";
                                    document.getElementById("ritnorm").style.display        = "none";
                                    document.getElementById("pendnorm").style.display       = "none";
                                    document.getElementById("normtun").style.display        = "none";
                                    document.getElementById("eff").style.display            = "none";
                                    document.getElementById("effflip").style.display        = "none";
                                    document.getElementById("effuni").style.display         = "none";
                                    document.getElementById("effrit").style.display         = "none";
                                    document.getElementById("effspi").style.display         = "none";
                                    document.getElementById("effgem").style.display         = "none";
                                    document.getElementById("effpend").style.display        = "none";
                                    document.getElementById("efftun").style.display         = "none";
                                    document.getElementById("effflippend").style.display    = "none";
                                    document.getElementById("efffuspend").style.display     = "none";
                                    document.getElementById("efffliptun").style.display     = "none";
                                    document.getElementById("efftunpend").style.display     = "none";
                                    document.getElementById("fus").style.display            = "none";
                                    document.getElementById("syn").style.display            = "none";
                                    document.getElementById("syntun").style.display         = "none";
                                    document.getElementById("synpend").style.display        = "none";
                                    document.getElementById("xyz").style.display            = "none";
                                    document.getElementById("xyzpend").style.display        = "none";
                                    document.getElementById("lien").style.display           = "none";
                                    document.getElementById("jet").style.display            = "none";
                                    document.getElementById("magNorm").style.display        = "block";
                                    document.getElementById("magCont").style.display        = "block";
                                    document.getElementById("magRap").style.display         = "block";
                                    document.getElementById("magEqu").style.display         = "block";
                                    document.getElementById("magTer").style.display         = "block";
                                    document.getElementById("magRit").style.display         = "block";
                                    document.getElementById("piegNorm").style.display       = "none";
                                    document.getElementById("piegCont").style.display       = "none";
                                    document.getElementById("piegCount").style.display      = "none";

                                    document.getElementById("monstre").style.display = "none";
                                    document.getElementById("skill").style.display = "none";
                                } else if (etat == "Trap Card") {
                                    document.getElementById("norm").style.display           = "none";
                                    document.getElementById("ritnorm").style.display        = "none";
                                    document.getElementById("pendnorm").style.display       = "none";
                                    document.getElementById("normtun").style.display        = "none";
                                    document.getElementById("eff").style.display            = "none";
                                    document.getElementById("effflip").style.display        = "none";
                                    document.getElementById("effuni").style.display         = "none";
                                    document.getElementById("effrit").style.display         = "none";
                                    document.getElementById("effspi").style.display         = "none";
                                    document.getElementById("effgem").style.display         = "none";
                                    document.getElementById("effpend").style.display        = "none";
                                    document.getElementById("efftun").style.display         = "none";
                                    document.getElementById("effflippend").style.display    = "none";
                                    document.getElementById("efffuspend").style.display     = "none";
                                    document.getElementById("efffliptun").style.display     = "none";
                                    document.getElementById("efftunpend").style.display     = "none";
                                    document.getElementById("fus").style.display            = "none";
                                    document.getElementById("syn").style.display            = "none";
                                    document.getElementById("syntun").style.display         = "none";
                                    document.getElementById("synpend").style.display        = "none";
                                    document.getElementById("xyz").style.display            = "none";
                                    document.getElementById("xyzpend").style.display        = "none";
                                    document.getElementById("lien").style.display           = "none";
                                    document.getElementById("jet").style.display            = "none";
                                    document.getElementById("magNorm").style.display        = "none";
                                    document.getElementById("magCont").style.display        = "none";
                                    document.getElementById("magRap").style.display         = "none";
                                    document.getElementById("magEqu").style.display         = "none";
                                    document.getElementById("magTer").style.display         = "none";
                                    document.getElementById("magRit").style.display         = "none";
                                    document.getElementById("piegNorm").style.display       = "block";
                                    document.getElementById("piegCont").style.display       = "block";
                                    document.getElementById("piegCount").style.display      = "block";

                                    document.getElementById("monstre").style.display = "none";
                                    document.getElementById("skill").style.display = "none";
                                }
                            } else if (etat == "Skill Card") {
                                document.getElementById("selectSpec").disabled = true;
                                document.getElementById("secondaire").style.display = "block";
                                document.getElementById("monstre").style.display = "none";
                                document.getElementById("skill").style.display = "block";
                            } else {
                                document.getElementById("selectSpec").disabled = true;
                                document.getElementById("secondaire").style.display = "none";
                            }
                        });
                    </script>
        
                    <hr>
                </div>
                <div id="secondaire" style="display:none">
                    <div id="monstre" style="display:none">
                        <div class="ms-2" style="display: inline-block;">
                            <div>
                                Attribut<select class="form-select form-select-sm mb-3" name="attribut" id="attribut" style="width:180px">
                                    <option selected></option>
                                    <option value="dark">Ténèbres</option>
                                    <option value="light">Lumière</option>
                                    <option value="earth">Terre</option>
                                    <option value="water">Eau</option>
                                    <option value="fire">Feu</option>
                                    <option value="wind">Vent</option>
                                    <option value="divine">Divin</option>
                                </select>
                            </div>
                        
                            <div>
                                Type<select class="form-select form-select-sm mb-3" name="type" id="type" style="width:180px">
                                    <option selected></option>
                                    <option value="Spellcaster">Magicien</option>
                                    <option value="Dragon">Dragon</option>
                                    <option value="Zombie">Zombie</option>
                                    <option value="Warrior">Guerrier</option>
                                    <option value="Beast-Warrior">Bête-guerrier</option>
                                    <option value="Beast">Bête</option>
                                    <option value="Winged Beast">Bête ailée</option>
                                    <option value="Fiend">Démon</option>
                                    <option value="Fairy">Elfe</option>
                                    <option value="Insect">Insecte</option>
                                    <option value="Dinosaur">Dinosaure</option>
                                    <option value="Reptile">Reptile</option>
                                    <option value="Fish">Poisson</option>
                                    <option value="Sea Serpent">Serpent de mer</option>
                                    <option value="Aqua">Aqua</option>
                                    <option value="Pyro">Pyro</option>
                                    <option value="Thunder">Tonnerre</option>
                                    <option value="Rock">Rocher</option>
                                    <option value="Plant">Plante</option>
                                    <option value="Machine">Machine</option>
                                    <option value="Psychic">Psychique</option>
                                    <option value="Divine-Beast">Bête-divine</option>
                                    <option value="Wyrm">Wyrm</option>
                                    <option value="Cyberse">Cyberse</option>
                                    <option value="Creator-God">Dieu créateur</option>
                                </select>
                            </div>
                            <div>
                                Niveau/Rang/Échelle/Classification
                                <input type="number" name="niv" class="form-control" style="width:180px">
                            </div>
                        </div>
                        <div class="me-2" style="display: inline-block;float: right">
                            <div>
                                Attaque
                                <input type="number" name="atk" class="form-control" style="width:180px">
                            </div>
                            <div>
                                Défense
                                <input type="number" name="def" class="form-control" style="width:180px">
                            </div>
                        </div>
                    </div>
                    <div id="skill" class="ms-2" style="display:none">
                        <div>
                            Pour
                            <select class="mt-2 form-select form-select-sm mb-3" name="pour" style="width:180px">
                                <option selected value="undefined"></option>
                                <option value="mai">Mai</option>
                                <option value="pegasus">Pégasus</option>
                                <option value="ishizu">Ishizu</option>
                                <option value="joey">Joey</option>
                                <option value="kaiba">Kaiba</option>
                                <option value="yugi">Yugi</option>
                            </select>
                        </div>
                    </div>
                    
                    <hr>
                </div>
            </form>
        </div>
        <div id="recherche" style="display: none">
            <div>
                <div class="card mb-1" style="width: 20rem; display: inline-block; height: 100rem;" v-for="c of cartes.data">
                    <div class="row g-0" v-if="typeContientMonstre(c.type)" >
                        <div class="col-md-4" v-for="i of c.card_images">
                            <img :src="i.image_url_small" class="card-img-top" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ c.name }}</h5>
                                <div><b class="card-item">{{c.type}}</b></div>
                                <div><b class="card-item">Niveau :</b>&nbsp;<span v-if="monstreIsLink(c.type)">{{c.linkval}}</span><span v-else>{{c.level}}</span></div>
                                <div><b class="card-item">Type :</b>&nbsp;{{c.race}}</div>
                                <div><b class="card-item">Attribut :</b>&nbsp;{{c.attribute}}</div>
                                <div><b class="card-item">Attaque :</b>&nbsp;{{c.atk}}</div>
                                <div><b class="card-item" v-if="monstreIsLink(c.type) == false">Défense :</b>&nbsp;{{c.def}}</div>
                                <div><b class="card-item">Texte :</b>
                                    <p>{{ c.desc }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 magie" v-if="typeContientMagie(c.type)">
                        <div class="col-md-4" v-for="i of c.card_images">
                            <img :src="i.image_url_small" class="card-img-top" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ c.name }}</h5>
                                <div><b class="card-item">{{c.race}}&nbsp;{{c.type}}</b></div>
                                <div><b class="card-item">Texte :</b>
                                    <p>{{ c.desc }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 piege" v-if="typeContientPiege(c.type)">
                        <div class="col-md-4" v-for="i of c.card_images">
                            <img :src="i.image_url_small" class="card-img-top" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ c.name }}</h5>
                                <div><b class="card-item">{{c.race}}&nbsp;{{c.type}}</b></div>
                                <div><b class="card-item">Texte :</b>
                                    <p>{{ c.desc }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 skill" v-if="typeContientSkill(c.type)">
                        <div class="col-md-4" v-for="i of c.card_images">
                            <img :src="i.image_url_small" class="card-img-top" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ c.name }}</h5>
                                <div><b class="card-item">{{c.type}}</b></div>
                                <div><b class="card-item">Pour :</b>&nbsp;{{c.race}}</div>
                                <div><b class="card-item">Texte :</b>
                                    <p>{{ c.desc }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 jeton" v-if="typeContientToken(c.type)">
                        <div class="col-md-4" v-for="i of c.card_images">
                            <img :src="i.image_url_small" class="card-img-top" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <h5 class="card-title">{{ c.name }}</h5>
                                <div><b class="card-item">{{c.type}}</b></div>
                                <div><b class="card-item">Niveau :</b>&nbsp;<span v-if="monstreIsLink(c.type)">{{c.linkval}}</span><span v-else>{{c.level}}</span></div>
                                <div><b class="card-item">Type :</b>&nbsp;{{c.race}}</div>
                                <div><b class="card-item">Attribut :</b>&nbsp;{{c.attribute}}</div>
                                <div><b class="card-item">Attaque :</b>&nbsp;{{c.atk}}</div>
                                <div><b class="card-item" v-if="monstreIsLink(c.type) == false">Défense :</b>&nbsp;{{c.def}}</div>
                                <div><b class="card-item">Texte :</b>
                                    <p>{{ c.desc }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
        <script>
            let url = new URL(document.location.href);
            let chemin = url.searchParams.get("apireq");

            if (typeof chemin != "object") {
                document.getElementById("recherche").style.display = "block";
                chemin = chemin.replace(new RegExp('@', 'g'),'&');
                const app = new Vue({
                el: "#recherche",
                data: {
                    cartes: [],
                    url: chemin
                },
                methods: {
                    typeContientMonstre(type) {
                        return type.includes("Monster");
                    },
                    monstreIsLink(monstre) {
                        return monstre.includes("Link");
                    },
                    typeMonstre(type) {
                        if (type.includes("XYZ")) return "xyz";
                        else return "eff";
                    },
                    typeContientMagie(type) {
                        return type.includes("Spell");
                    },
                    typeContientPiege(type) {
                        return type.includes("Trap");
                    },
                    typeContientSkill(type) {
                        return type.includes("Skill");
                    },
                    typeContientToken(type) {
                        return type.includes("Token");
                    }
                },
                mounted() {
                    axios.get(this.url).then((response) => {
                        this.cartes = response.data;
                    });
                },
                });
            }
        </script>
    </div>
</body>
</html>