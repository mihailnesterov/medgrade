
	/*
		In this project we will build a simple web app that searches 
		a JSON file using the Fetch API, Async/Await, Regex and 
		high order array methods. 
		https://www.youtube.com/watch?v=1iysNUrI3lw
		
		Use LAMP
	*/
    
    // get search input and div for search results
	const search = document.getElementById('search-input');
    const searchList = document.getElementById('search-list');
	
	// json filter - searchProduct(searchText) arrow function
	
	// async - т.к. await работатет тольк с acync
	const searchProduct = async searchText => {
		// searchText - input text
		// get data from json
		const res = await fetch('/wp-content/themes/medgrade/data/search.json');
		const products = await res.json();
		// get matches to current input 
		let matches = products.filter( state => {
			const regex = new RegExp(searchText, 'ig');
			return state.post_title.match(regex);
		});
		// clear if input empty
		if(searchText.length === 0) {
			matches = []; 
			searchList.innerHTML = '';
		}
		
		outputHTML(matches);

		// begin highlighting
		const searchTerm = search.value;
		$('.output-search-item').removeHighlight();
		if ( searchTerm ) {
			$('.output-search-item').highlight( searchTerm );
		}
		// end highlighting
	}
	
	// Output result to html
	const outputHTML = matches => {
		if( matches.length > 0 ) {
			const html = matches.map( match => `<p class="output-search-item" data-id="${ match.ID }" data-url="${ match.guid }">${ match.post_title }</p>`).join('');
			searchList.innerHTML = html;
			// add click listener on every search-list <p>
			const searchListItems = searchList.querySelectorAll('p');
			if(searchListItems) {
				for (let i = 0; i < searchListItems.length; i++) {
					searchListItems[i].addEventListener(
						'click',
						() => {
							search.value = searchListItems[i].textContent;
							location.href = searchListItems[i].dataset.url;
						}
					)
				}
			}
        }
	}
	
	// add input listener on search-input
	search.addEventListener(
		'keyup',
		() => searchProduct(search.value)
	)

	// highlighting as JQuery plugin
	// 2 methods: highlight, removeHighlight
	jQuery.fn.highlight = function(pat) {
		function innerHighlight(node, pat) {
			let skip = 0;
			if (node.nodeType == 3) {
				const pos = node.data.toUpperCase().indexOf(pat);
				if (pos >= 0) {
					const spannode = document.createElement('span');
					spannode.className = 'highlight';
					const middlebit = node.splitText(pos);
					const endbit = middlebit.splitText(pat.length);
					const middleclone = middlebit.cloneNode(true);
					spannode.appendChild(middleclone);
					middlebit.parentNode.replaceChild(spannode, middlebit);
					skip = 1;
				}
			}
			else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)) {
				for (let i = 0; i < node.childNodes.length; ++i) {
					i += innerHighlight(node.childNodes[i], pat);
				}
			}
			return skip;
		}
		
		return this.each(function() {
			innerHighlight(this, pat.toUpperCase());
		});
	};

	jQuery.fn.removeHighlight = function() {
		function newNormalize(node) {
		for (let i = 0, children = node.childNodes, nodeCount = children.length; i < nodeCount; i++) {
			const child = children[i];
			if (child.nodeType == 1) {
				newNormalize(child);
				continue;
			}
				if (child.nodeType != 3) { continue; }
				const next = child.nextSibling;
				if (next == null || next.nodeType != 3) { continue; }
				const combined_text = child.nodeValue + next.nodeValue;
				new_node = node.ownerDocument.createTextNode(combined_text);
				node.insertBefore(new_node, child);
				node.removeChild(child);
				node.removeChild(next);
				i--;
				nodeCount--;
			}
		}

		return this.find("span.highlight").each(function() {
			const thisParent = this.parentNode;
			thisParent.replaceChild(this.firstChild, this);
			newNormalize(thisParent);
		}).end();
	};
	// end highlighting JQuery plugin