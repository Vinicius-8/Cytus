# Cytus
This php project provides a web visualisation for the process of graph traversal, showing step by step every node that the code passes through.  
<p align="center">
    
    
<img src="https://user-images.githubusercontent.com/33498293/81461445-3b9ad400-9182-11ea-8787-2ac7b04dcad3.gif" width="600" height="336" alt="Noteum GiF">

</p>

### Dependencies 

* All the visual artefacts and models that implements the search's state were made using the API [Cytoscape.js](http://js.cytoscape.org). 
    
    ![Cytoscape.js version](https://img.shields.io/badge/Cytoscape-v3.5.1-yellow)

* The menu options and features were made with [JQuery](https://jquery.com/) and [Bootstrap](https://getbootstrap.com/).

    ![JQuery version](https://img.shields.io/badge/JQuery-v3.3.1-green)
    ![Bootstrap version](https://img.shields.io/badge/Bootstrap-v4.0.0-blueviolet)

### Context 
This algorithm tries to find the best path to arrive at specific city. The cities used as example are placed in [Paraná](https://www.google.com.br/maps/@-25.7148899,-50.0905473,9.5z) (state of Brazil).

### Algorithms 
* Depth-first search
* Breadth-first search
* A* (A-star)
* Greedy algorithm

### Usage
1. #### Select the origin city.
1. #### Select the destination city.
1. #### Select the algorithm to explore the graph.
1. #### Run
