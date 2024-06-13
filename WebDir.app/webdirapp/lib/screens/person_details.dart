import 'package:flutter/material.dart';
import 'package:webdirapp/models/person.dart';
import 'package:url_launcher/url_launcher.dart';

class PersonDetails extends StatefulWidget {
  final Person person;
  const PersonDetails({super.key, required this.person});

  @override
  State<PersonDetails> createState() => _PersonDetailsState();
}

class _PersonDetailsState extends State<PersonDetails> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Informations de ${widget.person.firstName} ${widget.person.lastName}'),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        backgroundColor: Colors.yellow,
      ),
      body: Column(
        children: <Widget>[
          Padding(
            padding: const EdgeInsets.all(50.0),
            child: CircleAvatar(
              backgroundImage: widget.person.image != null
                  ? NetworkImage(widget.person.image!)
                  : null,
              radius: 50,
              child: widget.person.image == null
                  ? Text(widget.person.firstName[0] + widget.person.lastName[0])
                  : null,
            ),
          ),
          ListTile(
            title: const Text('Prénom'),
            subtitle: Text(widget.person.firstName),
            shape: const Border(bottom: BorderSide(color: Colors.grey)),
          ),
          ListTile(
            title: const Text('Nom'),
            subtitle: Text(widget.person.lastName),
            shape: const Border(bottom: BorderSide(color: Colors.grey)),
          ),
          ListTile(
            title: const Text('Numéro de bureau'),
            subtitle: Text(widget.person.numBureau),
            shape: const Border(bottom: BorderSide(color: Colors.grey)),
          ),
          GestureDetector(
            child: ListTile(
              title: const Text('Email'),
              subtitle: Text(widget.person.email),
              shape: const Border(bottom: BorderSide(color: Colors.grey)),
              trailing: const Icon(Icons.mail),
            ),
            onTap: () {
              String url = 'mailto: ${widget.person.email}';
              launchUrl(Uri.parse(url));
            },
            ),
          GestureDetector(
            child: ListTile(
            title: const Text('Téléphone fixe'),
            subtitle: Text(widget.person.telFixe),
            shape: const Border(bottom: BorderSide(color: Colors.grey)),
            trailing: const Icon(Icons.phone),
            ),
            onTap: () {
              String url = 'tel: ${widget.person.telFixe}';
              launchUrl(Uri.parse(url));
            },
          ),
          GestureDetector(
            child: ListTile(
              title: const Text('Téléphone mobile'),
              subtitle: Text(widget.person.telMobile),
              shape: const Border(bottom: BorderSide(color: Colors.grey)),
              trailing: const Icon(Icons.phone),
            ),
            onTap: () {
              String url = 'tel: ${widget.person.telMobile}';
              launchUrl(Uri.parse(url));
            },
          ),
        ],
      ),
    );
  }
}