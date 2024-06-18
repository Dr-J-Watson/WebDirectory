import 'package:flutter/material.dart';
import 'package:webdirapp/models/entry.dart';
import 'package:url_launcher/url_launcher.dart';

class EntryDetails extends StatefulWidget {
  final Entry entry;
  const EntryDetails({super.key, required this.entry});

  @override
  State<EntryDetails> createState() => _EntryDetailsState();
}

class _EntryDetailsState extends State<EntryDetails> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Informations de ${widget.entry.firstName} ${widget.entry.lastName}'),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        shape: const Border(
          bottom: BorderSide(
            color: Colors.black,
            width: 2
          )
        ),
      ),
      body: Column(
        children: <Widget>[
          Padding(
            padding: const EdgeInsets.all(25.0),
            child: CircleAvatar(
              backgroundImage: widget.entry.image != null
                  ? NetworkImage(widget.entry.image!)
                  : null,
              radius: 75,
              child: widget.entry.image == null
                  ? Text(widget.entry.firstName[0] + widget.entry.lastName[0])
                  : null,
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(20.0),
            child: Column(
              children: <Widget>[
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                    Text('${widget.entry.firstName} ${widget.entry.lastName.toUpperCase()}',
                      style: const TextStyle(
                        fontSize: 20,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ],
                ),
                Text(widget.entry.function,
                  style: const TextStyle(
                    fontSize: 15,
                  ),
                ),
              ],
            )
          ),
          ListTile(
            title: const Text('Numéro de bureau'),
            subtitle: Text(widget.entry.numBureau),
            shape: const Border(
              bottom: BorderSide(color: Colors.grey),
              top: BorderSide(color: Colors.black),
              ),
          ),
          ListTile(
            title: const Text('Service(s)/Département(s)'),
            subtitle: Text(widget.entry.services.join(', ')),
            shape: const Border(bottom: BorderSide(color: Colors.grey)),
          ),
          GestureDetector(
            child: ListTile(
              title: const Text('Email'),
              subtitle: Text(widget.entry.email),
              shape: const Border(bottom: BorderSide(color: Colors.grey)),
              trailing: const Icon(Icons.mail),
            ),
            onTap: () {
              String url = 'mailto: ${widget.entry.email}';
              launchUrl(Uri.parse(url));
            },
            ),
          
          GestureDetector(
            child: ListTile(
              title: const Text('Téléphone mobile'),
              subtitle: Text(widget.entry.telMobile ?? 'Non renseigné'),
              shape: const Border(bottom: BorderSide(color: Colors.grey)),
              trailing: widget.entry.telMobile != null ? const Icon(Icons.phone) : null,
            ),
            onTap: () {
              if(widget.entry.telMobile != null) {
              String url = 'tel: ${widget.entry.telMobile}';
              launchUrl(Uri.parse(url));
              }
            },
          ),
          GestureDetector(
            child: ListTile(
            title: const Text('Téléphone fixe'),
            subtitle: Text(widget.entry.telFixe ?? 'Non renseigné'),
            shape: const Border(bottom: BorderSide(color: Colors.grey)),
            trailing: widget.entry.telFixe != null ? const Icon(Icons.phone) : null,
            ),
            onTap: () {
              if(widget.entry.telFixe != null){
                String url = 'tel: ${widget.entry.telFixe}';
                launchUrl(Uri.parse(url));
              } 
            },
          ),
        ],
      ),
    );
  }
}